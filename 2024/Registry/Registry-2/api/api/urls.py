from django.contrib import admin
from django.urls import include, path
from api import views

urlpatterns = [
    path('domain/verify/', views.verify_domain),
    path('domain/create/', views.create_domain),
]
