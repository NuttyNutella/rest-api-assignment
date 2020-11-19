<form action="<?php echo e(route('import')); ?>" method="post" enctype="multipart/form-data">	    
<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">		    
<h4><label> Please Select File (CSV only):</label>		    
<input type="file" name="csvfile"/></h4>	    
<h4><input type="submit" name="import" value="Import"/></h4>	    
</form><?php /**PATH C:\Users\Asus\api-assignment\resources\views/upload.blade.php ENDPATH**/ ?>