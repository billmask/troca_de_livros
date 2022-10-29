<?php

function display_errors_forms($validation, $field)
{
  if ($validation->hasError($field)) {
    return $validation->getError($field);
  } else {
    return false;
  }
}
