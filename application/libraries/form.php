<?php
class Form {
  function make_form_input_data($data, $default_value) {
    $onfocus = 'this.select();';
    
    $data['form_input_data'] = array(
      'name'        => 'grief',
//      'id'          => 'username',
      'value'       => $default_value,
      'maxlength'   => '100',
      'size'        => '32',
//      'style'       => 'width:50%',
      'onfocus'     => $onfocus,
    );
    
    return $data;
  }
}
?>
