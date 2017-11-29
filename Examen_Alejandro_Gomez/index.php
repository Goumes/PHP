<?php

echo '
<!DOCTYPE html>
<html>
<body>

<form action="data-reception.php" method="post">
    <label>Verb: </label> <input type="text" name="verb" />
    <br/>    
    
    <label>1st Element of URL: </label> <input type="text" name="url1" />
    <br/>
        
    <label>2nd Element of URL: </label> <input type="text" name="url2" />
    <br/>
        
    <label>3rd Element of URL: </label> <input type="text" name="url3" />
    <br/>
    <hr/>
        
    <label>1st Element of Body: </label> <input type="text" name="body1" /><label> Value: </label> <input type="text" name="value1" />
    <br/>
            
    <label>2nd Element of Body: </label> <input type="text" name="body2" /><label> Value: </label> <input type="text" name="value2" />
    <br/>
            
    <label>3rd Element of Body: </label> <input type="text" name="body3" /><label> Value: </label> <input type="text" name="value3" />
    <br/>
            
    <label>4th Element of Body: </label> <input type="text" name="body4" /><label> Value: </label> <input type="text" name="value4" />
    <br/>
            
    <label>5th Element of Body: </label> <input type="text" name="body5" /><label> Value: </label> <input type="text" name="value5" />
    <br/>
    

  <input type="submit" value="Submit">
</form> 


</body>
</html>
';