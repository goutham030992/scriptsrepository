#!/usr/bin/python
import boto3
import re
import sys

orig_stdout = sys.stdout
f = open('hostlist.dat', 'w')
sys.stdout = f

access_key = "xxxxx"
secret_key = "xxxxx"

client = boto3.client('ec2', aws_access_key_id=access_key, aws_secret_access_key=secret_key,
                                  region_name='us-east-1')

ec2_regions = [region['RegionName'] for region in client.describe_regions()['Regions']]

for region in ec2_regions:
    conn = boto3.resource('ec2', aws_access_key_id=access_key, aws_secret_access_key=secret_key,
                   region_name=region)
    instances = conn.instances.filter()
    for instance in instances:
        for tag in instance.tags:
          if tag["Key"] == 'Name':
            instancename = tag["Value"]
        print (instance.private_ip_address + "\t" + instancename + "\t" + instance.id)


sys.stdout = orig_stdout
f.close()

