<?php
use Illuminate\Html\FormBuilder;


FormBuilder::macro('bsText', function ($name, $label = "", $value = null, $options = array()) {
    return FormBuilder::bsWrapper($name, $label, $options, function ($name, $options) {
        return Form::text($name, null, $options);
    });
});

FormBuilder::macro('bsPassword', function ($name, $label = "", $options = array()) {
    return FormBuilder::bsWrapper($name, $label, $options, function ($name, $options) {
        return Form::password($name, $options);
    });
});

FormBuilder::macro('bsWrapper', function ($name, $label, $options, $callback) {
    if(array_key_exists("class", $options)){
        $options["class"]+=" form-control";
    }else{
        $options["class"]="form-control";
    }
    $errors = Session::get('errors', new Illuminate\Support\MessageBag);
    return sprintf('<div class="form-group %s">%s%s%s</div>',
        $errors->has($name) ? 'has-error' : '',
        $label ? '<label class="control-label">' . $label . '</label>' : null,
        $callback($name, $options),
        $errors->first($name, '<span class="help-block">:message</span>')
    );
});