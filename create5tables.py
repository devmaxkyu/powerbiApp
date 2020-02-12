# import libraries
import sys, os, json
from datetime import datetime
import adal
import logging
from zeminpowerbi.dataset import Column, Table, Dataset, Relationship, Row
from zeminpowerbi.client import PowerBIClient
from zeminpowerbi.group import Group

# enable debug, if you won't debug, add commit
logging.basicConfig(level=logging.DEBUG)

''' === Configration For Authentication ==='''
APP_ID = ''
USER = ""
PASS = ""
TENANT_ID = ''
''' ======================================='''

# constant variables
RESOURCE = "https://analysis.windows.net/powerbi/api"
AUTHORITY_URL = ("https://login.microsoftonline.com" + '/' + TENANT_ID)
API_URL = "https://api.powerbi.com"

if  __name__ == "__main__":
    ### Authentication Begin
    context = adal.AuthenticationContext(AUTHORITY_URL, api_version=None)
    token = context.acquire_token_with_username_password(
        RESOURCE, USER, PASS, APP_ID)

    if not token:
        raise RuntimeError("Authentication Failed")
    ### ====================


    ### Create your powerbi api client
    client = PowerBIClient(API_URL, token)
    ### ==============================

    ### Create a new workspace
    while True:
        print('Enter your new workspace name:')
        workspace_name = input()

        if workspace_name:
            break 
    
    group = Group(name = workspace_name)
    created_group = client.groups.create_group(group)
    logging.info("Created a new Workspace")
    ### =======================

    ### Create tables
    #tables
    tables = []

    # create Date_Info table
    columns = []
    
    columns.append(Column(name='Business Date', data_type='datetime'))
    columns.append(Column(name='Day of Week', data_type='string'))
    columns.append(Column(name='Day of Week Number', data_type='Int64'))
    columns.append(Column(name='Month', data_type='string'))
    columns.append(Column(name='Year', data_type='Int64'))
    columns.append(Column(name='Period', data_type='Int64'))
    columns.append(Column(name='Week In Period', data_type='Int64'))
    columns.append(Column(name='Week of Year', data_type='Int64'))
    columns.append(Column(name='Period Week', data_type='string'))

    tables.append(Table(name='Date_Info', columns=columns))

    # create Daypart_Info table
    columns = []
    
    columns.append(Column(name='Hour of Day', data_type='string'))
    columns.append(Column(name='Day Part Name', data_type='string'))

    tables.append(Table(name='Daypart_Info', columns=columns))

    # create Product_Info table
    columns = []
    
    columns.append(Column(name='Product ID', data_type='Int64'))
    columns.append(Column(name='Product Name', data_type='string'))
    columns.append(Column(name='Major Category', data_type='string'))
    columns.append(Column(name='Sub Category', data_type='string'))
    columns.append(Column(name='Exclude Flag', data_type='string'))

    tables.append(Table(name='Product_Info', columns=columns))

    # create Store_Info table
    columns = []
    
    columns.append(Column(name='Store ID', data_type='string'))
    columns.append(Column(name='State', data_type='string'))
    columns.append(Column(name='District', data_type='string'))
    columns.append(Column(name='Address', data_type='string'))
    columns.append(Column(name='City', data_type='string'))
    columns.append(Column(name='Zip', data_type='string'))
    columns.append(Column(name='Latitude', data_type='string'))
    columns.append(Column(name='Longitude', data_type='string'))
    columns.append(Column(name='Store Name', data_type='string'))

    tables.append(Table(name='Store_Info', columns=columns))

    # create Transaction_Detail table
    columns = []
    
    columns.append(Column(name='Record Type', data_type='string'))
    columns.append(Column(name='Revenue Center', data_type='Int64'))
    columns.append(Column(name='Order Type', data_type='Int64'))
    columns.append(Column(name='Check Number', data_type='Int64'))
    columns.append(Column(name='Business Date', data_type='datetime'))
    columns.append(Column(name='Transaction Time', data_type='datetime'))
    columns.append(Column(name='Detail Type', data_type='Int64'))
    columns.append(Column(name='Price Level', data_type='Int64'))
    columns.append(Column(name='Product ID', data_type='Int64'))
    
    columns.append(Column(name='Void Flag', data_type='Int64'))
    columns.append(Column(name='Return Flag', data_type='Int64'))
    columns.append(Column(name='Quantity', data_type='Int64'))
    columns.append(Column(name='Sales', data_type='string'))
    columns.append(Column(name='Employee ID', data_type='Int64'))
    columns.append(Column(name='Store ID', data_type='string'))

    tables.append(Table(name='Transaction_Detail', columns=columns))

    ### Create a Dataset
    while True:
        print('Enter your new Dataset name:')
        dataset_name = input()

        if dataset_name:
            break 
    
    dataset = Dataset(name=dataset_name, tables=tables)

    created_dataset = client.datasets.post_dataset(dataset, created_group.id)
    logging.info("Created a new dataset")

    print("Teminated Processing ~")
    sys.exit(0)
