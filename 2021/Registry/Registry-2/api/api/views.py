import os

from django.shortcuts import render
from rest_framework.views import APIView
from rest_framework.response import Response
from rest_framework.permissions import *
from rest_framework.decorators import api_view


@api_view(['GET'])
def verify_domain(request):
    file_content = os.popen('cat /etc/bind/db.benin').read()
    return Response({
        'status': f"{request.GET.get('domain')}." in file_content
    })

@api_view(['POST'])
def create_domain(request):
    name = request.data.get('name', '')
    ns1 = request.data.get('ns1', '')
    ns2 = request.data.get('ns2', '')

    try:
        with open('/etc/bind/db.benin', 'a') as zone_file:
            zone_file.write(f"\n\n{name}.    NS     {ns1}.")
            zone_file.write(f"{name}.    NS     {ns2}.")
            os.popen('service bind9 reload').read()
    except Exception as e:
        return Response({
            'status': False
        })
    return Response({
        'status': True
    })
