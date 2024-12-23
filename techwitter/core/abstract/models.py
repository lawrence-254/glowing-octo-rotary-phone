from django.db import models
import uuid

from django.core.exceptions import ObjectDoesNotExist
from django.http import Http404

class AbstractManager(models.Manager):
    def get_object_by_public_id(self, public_id):
        """
        Retrieve an object by its public ID.
        Raises Http404 if the object does not exist.
        """
        try:
            instance = self.get(public_id=public_id)
            return instance
        except (ObjectDoesNotExist, ValueError, TypeError):
            raise Http404("Object with the specified public_id does not exist.")
        
class AbstractModel(models.Model):
    public_id = models.UUIDField(db_index=True, unique=True, default=uuid.uuid4, editable=False)
    created_at = models.DateTimeField(auto_now_add=True)
    updated_at = models.DateTimeField(auto_now=True)


    objects = AbstractManager()

    class Meta:
        abstract = True