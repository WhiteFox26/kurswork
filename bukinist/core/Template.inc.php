<?php
class Template
{
    protected $Params;
    protected $FileName;
    protected $ContentView;
    protected $isAjaxRequest = false;

    public function __construct($fileName)
    {
        $this->Params = array();
        $this->FileName = $fileName;
    }

    public function AjaxRequest()
    {
        $this->isAjaxRequest=true;
    }

    public function setParam($name,$value)
    {
        if(!empty($name))
            $this->Params[$name] = $value;
    }

    public function setContentView($contentView)
    {
        if(empty($contentView))
            $this->ContentView = 'templates/index.tpl.php';
        else
            $this->ContentView =$contentView;

        $this->setParam('content_view',$this->ContentView);
    }

    public function setParams($arr)
    {

        if(!empty($arr))
            $this->Params = array_merge($this->Params,$arr);

    }

    public function fetch()
    {
        extract($this->Params);

        ob_start();
        include($this->FileName);
        $html = ob_get_contents();
        ob_end_clean();
        return $html;
    }

    public function display()
    {
        if(!$this->isAjaxRequest)
            echo $this->fetch();
    }
}
?>