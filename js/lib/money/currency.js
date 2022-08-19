/**
 * Currency Utils
 * 
 * This class prepares the value to be shown into html view without
 * uses a php request to format the needed values
 * 
 * 
 */
function setCurrency(value, isPrefix){
    
    //Change from number to string
    value = value.toString();
   
    var result_value = "";
    var n_dot = value.replace(".", ",");   
    var rs = n_dot.replace("R$", "");
    var vl = rs.split(",");
    var new_value = "";

    if(vl.length > 1){       
       new_value = formatValueToString(vl);     
    }else{
       new_value = value + ",00";
    }

    
    result_value = new_value;
    if(isPrefix) result_value = "R$" + new_value;
   
    return result_value;
    
}

/*
 * Helper method to format to new formated value
 * 
 * @param array
 * 
 */
function formatValueToString(arr_value){
    
    var vl_new = "";
    
    if(arr_value[1] > 0){
        vl_new = arr_value[0] + "," + arr_value[1];
    }
    
    if(arr_value[1] == 0){
        vl_new = arr_value[0] + ",00";
    }
    
    return vl_new;
}

/*
 * Helper method to format to new formated value
 * 
 * @param number or string
 * 
 */
function formatValueToFloat(value){
    
    var vl_new = "";    
    vl_new = value.replace(",", ".");
    
    return vl_new;
}