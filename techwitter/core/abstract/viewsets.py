from rest_framework import viewsets
from rest_framework import filters

class AbstractViewSet(viewsets.ModelViewSet):
    filter_backends= [filters.OderingFilter]
    ordering_fields = ['updated_at', 'created_at']
    oredering= ['-updated_at']