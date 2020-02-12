import json

class Setting:

    resource_uri = None
    tenant_id = None
    authority_host_uri = None
    authority_uri = None
    client_id = None
    client_secrect = None
    api_uri = None
    group_id = None
    username  = None
    password = None
    datasource = None
    dict_config = None

    def __init__(self, path):        

        if path:
            with open(path, 'r') as f:
                path = f.read()
            self.dict_config = json.loads(path)            
        else:    
            raise ValueError('Please provide parameter file with account information.')
        
        self.resource_uri = self.dict_config['resource']
        if not self.resource_uri:
            raise ValueError('Please provide resource parameter.')

        self.tenant_id = self.dict_config['tenant']
        if not self.tenant_id:
            raise ValueError('Please provide tenant parameter.')

        self.authority_host_uri = self.dict_config['authorityHostUrl']
        if not self.authority_host_uri:
            raise ValueError('Please provide authorityHostUrl parameter.')

        self.client_id = self.dict_config['clientId']
        if not self.client_id:
            raise ValueError('Please provide clientId parameter.')

        self.client_secrect = self.dict_config['clientSecret']
        self.username = self.dict_config['username']
        
        if not self.client_secrect and not self.username:
            raise ValueError('Please provide clientSecret or username&password parameter.')
        
        if self.username:
            self.password = self.dict_config['password']
            if not self.password and not self.client_secrect:
                raise ValueError('Please provide password parameter.')

        
        self.api_uri = self.dict_config['api_url']
        if not self.api_uri:
            raise ValueError('Please provide api_url parameter.')


        self.group_id = self.dict_config['group_id']
        if not self.group_id:
            raise ValueError('Please provide group_id parameter.')


        self.datasource = self.dict_config['datasource']
        if not self.datasource:
            raise ValueError('Please provide datasource parameter.')


        if self.authority_host_uri[-1] is '/':
            self.authority_uri = self.authority_host_uri + self.tenant_id
        else:
            self.authority_uri = self.authority_host_uri  + '/' + self.tenant_id