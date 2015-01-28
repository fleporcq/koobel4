<?php
/**
 * Created by IntelliJ IDEA.
 * User: fleporcq
 * Date: 28/01/15
 * Time: 17:50
 */

class KoobeController extends BaseController{
    public function __construct()
    {
        $this->beforeFilter('auth');
    }
}