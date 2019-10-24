
# You can provide account information by using a JSON file. Either
# through a command line argument, 'python demo.py config.json', or
# specifying in an environment variable of ADAL_SAMPLE_PARAMETERS_FILE.
#
# {
#    "resource": "your_resource",
#    "tenant" : "your_tenant_id",
#    "authorityHostUrl" : "https://login.microsoftonline.com",
#    "clientId" : <ClientID>,
#    "clientSecret" : <ClientSecret>"
# }

ADAL_SAMPLE_PARAMETERS_FILE = {}

# import libraries
import sys, os, json
from datetime import datetime
import adal
import logging
from zeminpowerbi.dataset import Column, Table, Dataset, Relationship, Row
from zeminpowerbi.client import PowerBIClient

# generate random integer values
from random import seed
from random import randint, uniform

# enable debug, if you won't debug, add commit
logging.basicConfig(level=logging.DEBUG)

# read configration json file
parameters_file = (sys.argv[1] if len(sys.argv) == 2 else
                os.environ.get('ADAL_SAMPLE_PARAMETERS_FILE'))

if parameters_file:
    with open(parameters_file, 'r') as f:
        parameters = f.read()
    CONFIG = json.loads(parameters)
else:    
    raise ValueError('Please provide parameter file with account information.')

# Global Variables

RESOURCE = CONFIG.get('resource', "00000002-0000-0000-c000-000000000000")
AUTHORITY_URL = (CONFIG['authorityHostUrl'] + '/' + CONFIG['tenant'])


def authenticate_client_key():

    ### Main logic begins
    context = adal.AuthenticationContext(
        AUTHORITY_URL, validate_authority=CONFIG['tenant'] != 'adfs',
        )

    token = context.acquire_token_with_client_credentials(
        RESOURCE,
        CONFIG['clientId'],
        CONFIG['clientSecret'])

    return token


def authenticate_username_password():
    """
    Authenticate using user w/ username + password.
    This doesn't work for users or tenants that have multi-factor authentication required.
    """                
    context = adal.AuthenticationContext(AUTHORITY_URL, api_version=None)
    token = context.acquire_token_with_username_password(
        RESOURCE, CONFIG["username"], CONFIG["password"], CONFIG['clientId'])

    return token


def createRelationExampleDataset():
    # create your tables
    tables = []

    # create product table
    columns = []
    
    columns.append(Column(name='id', data_type='Int64'))
    columns.append(Column(name='name', data_type='string'))
    columns.append(Column(name='store_id', data_type='Int64'))
    columns.append(Column(name='price', data_type='double'))
    columns.append(Column(name='created_at', data_type='datetime'))

    tables.append(Table(name='Product', columns=columns))

    # create store table
    columns = []
    
    columns.append(Column(name='id', data_type='Int64'))
    columns.append(Column(name='name', data_type='string'))
    columns.append(Column(name='created_at', data_type='datetime'))

    tables.append(Table(name='Store', columns=columns))

    # create your relationships
    relationships = []

    # create relationships between product and store
    relationships.append(Relationship(name="FK_product_store", fromTable="Product", 
                                        fromColumn="store_id", toTable="Store", toColumn="id"))


    # create your dataset
    now = datetime.now()
    timestamp = datetime.timestamp(now)

    dataset = Dataset(name='ExampleRelationshipDataset_'+str(timestamp).replace('.','_'), tables=tables, relationships=relationships)

    return dataset


def createStores():
    store_rows = []
    for x in range(1, 10):
        store_rows.append(Row(id=x, name="store"+str(x), created_at = "10/24/2019"))

    
    return store_rows

def createProducts():
    # seed random number generator
    seed(1)
    product_rows = []
    for x in range(1, 50):
        product_rows.append(Row(id=x, name="product"+str(x), store_id=randint(1, 10), price= round(uniform(22.5, 400.5), 2), created_at = "10/24/2019"))

    return product_rows

if  __name__ == "__main__":
    
    # authenticate 
    token = authenticate_username_password()
    logging.info("Received token")

    # create your powerbi api client
    client = PowerBIClient(CONFIG['api_url'], token)


    # push your example dataset with relationships
    new_dataset = createRelationExampleDataset()
    created_dataset = client.datasets.post_dataset(new_dataset, CONFIG['group_id'])
    logging.info("Created dataset")

    

    # push rows into Store table
    stores = createStores()
    client.datasets.post_rows(created_dataset.id, "Store", stores, group_id=CONFIG['group_id']) # push rows into Store table

    # push rows into Product table
    products = createProducts()
    client.datasets.post_rows(created_dataset.id, "Product", products, group_id=CONFIG['group_id']) # push rows into Product table
    logging.info("Pushed rows")
    
    print("Teminated Processing ~")
    sys.exit(0)