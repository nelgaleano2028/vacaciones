<?php
@session_start();


class vacaciones{
    
    private $codigo_jefe=null;
    private $lista=null;
    
    private $concepto=null;
    private $cod_epl=null;
    private $inicial=null;
    private $finall=null;
    private $area=null;
    private $dias=null;
    private $cod_ausencia=null;
    private $consecutivo=null;
    private $observacion=null;
    private $encargado=null;
    
    
    
    public function set_concepto($concepto){
     $this->concepto=$concepto;
    }
     public function set_encargado($encargado){
     $this->encargado=$encargado;
    }
    public function set_observacion($observacion){
        $this->observacion=$observacion;
    }
    public function set_cod_epl($cod_epl){
     $this->cod_epl=$cod_epl;
    }
    public function set_inicial($inicial){
     $this->inicial=$inicial;
    }
    public function set_final($final){
     $this->finall=$final;
    }
    public function set_area($area){
     $this->area=$area;
    }
    public function set_dias($dias){
     $this->dias=$dias;
    }
     public function set_cod_ausencia($cod_ausencia){
     $this->cod_ausencia=$cod_ausencia;
    }
    public function set_consecutivo($consecutivo){
        $this->consecutivo=$consecutivo;
    }
    
    private function get_concepto(){
     return $this->concepto;
    }
    private function get_encargado(){
     return $this->encargado;
    }
    private function get_observacion(){
        return $this->observacion;
    }
     private function get_consecutivo(){
     return $this->consecutivo;
    }
    private function get_cod_epl(){
     return $this->cod_epl;
    }
    private function get_inicial(){
     return $this->inicial;
    }
    private function get_final(){
     return $this->finall;
    }
    private function get_area(){
     return $this->area;
    }
    private function get_dias(){
     return $this->dias;
    }
     private function get_cod_ausencia(){
     return $this->cod_ausencia;
    }
        /*@method vacaciones_email
         *Retorna los datos del empleado para enviarle un email
         *de aceptacon o de rechazo.
        */
    
     /*
         *@method mensaje_solicitud plantilla de correo de vacaciones
         *@param $contenido es el cuerpo del mensaje.
         *@param $portal direccion url de la pagina de la empresa.
         *@param $youtube url del canal de youtube de la empresa.
         *@param $twitter url de la pagina de la empresa.
         *@param $titulo titulo del mensaje.
         *@param $imagen imagen del encabezado esta imagen no puede llamar local debe llamarce de una url de internet.
         *
        */
        public function mensaje_solicitud($contenido,$portal,$youtube,$facebook,$twitter,$titulo,$imagen=' http://sia1.subirimagenes.net/img/2013/07/26/13072605244398437.png'){
            
          $html='
                <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                <html class=" js no-flexbox rgba hsla multiplebgs backgroundsize borderimage borderradius boxshadow textshadow opacity cssanimations csscolumns cssgradients cssreflections csstransforms no-csstransforms3d csstransitions fontface generatedcontent">
                <head>
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
                <!--[if gte mso 9]>
                <style _tmplitem="116" >
                  .article-content ol, .article-content ul {
                   margin: 0 0 0 24px;
                   padding: 0;
                   list-style-position: inside;
                   }
                </style>
                <![endif]-->
           
           </head>
           <body>
           <table width="100%" cellpadding="0" cellspacing="0" border="0" id="background-table">
                   <tbody>
                           <tr>
                                   <td align="center" bgcolor="#ececec">
                                   <table class="w640" style="margin:0 10px;" width="640" cellpadding="0" cellspacing="0" border="0">
                                   <tbody>
                                                           <tr>
                                                                   <td class="w640" width="640" height="20"></td>
                                                           </tr>
                                   <tr>
                                                   <td class="w640" width="640">
                                           <table id="top-bar" class="w640" width="640" cellpadding="0" cellspacing="0" border="0" bgcolor="#425470">
                                                           <tbody><tr>
                   <td class="w15" width="15"></td>
                   <td class="w325" width="350" valign="middle" align="left">
                       <table class="w325" width="350" cellpadding="0" cellspacing="0" border="0">
                           <tbody><tr><td class="w325" width="350" height="8"></td></tr>
                       </tbody></table>
                       <div style=" font-size: 12px; color: #D9FFFD;">';
                       if($youtube != null){
                       $html.='<a style="font-weight: bold; color: #D9FFFD; text-decoration: none;  font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;" href="http://'.$portal.'" target="_blank">Portal</a><span class="hide">';
                       }
                       if($youtube != null){
                        $html.=' &nbsp;|&nbsp; <a style="font-weight: bold; color: #D9FFFD; text-decoration: none;  font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;" href="http://'.$youtube.'" lang="es-ES" target="_blank">Youtube</a>';
                       }
                       if($facebook != null){
                        $html.=' &nbsp;|&nbsp; <a style="font-weight: bold; color: #D9FFFD; text-decoration: none;  font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;" href="http://'.$facebook.'" target="_blank">Facebook</a></span><span class="hide">';
                       }
                       if($twitter != null){
                        $html.=' &nbsp;|&nbsp; <a style="font-weight: bold; color: #D9FFFD; text-decoration: none;  font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;" href="http://'.$twitter.'" target="_blank">Twitter</a>';
                       }
                       $html.='
                       </span></div>
                       <table class="w325" width="350" cellpadding="0" cellspacing="0" border="0">
                           <tbody><tr><td class="w325" width="350" height="8"></td></tr>
                       </tbody></table>
                   </td>
                   <td class="w30" width="30"></td>
                   <td class="w255" width="255" valign="middle" align="right">
                       <table class="w255" width="255" cellpadding="0" cellspacing="0" border="0">
                           <tbody><tr><td class="w255" width="255" height="8"></td></tr>
                       </tbody></table>
                       <table class="w255" width="255" cellpadding="0" cellspacing="0" border="0">
                           <tbody><tr><td class="w255" width="255" height="8"></td></tr>
                       </tbody></table>
                   </td>
                   <td class="w15" width="15"></td>
               </tr>
           </tbody></table>
                                   
                               </td>
                           </tr>
                           <tr>
                           <td id="header" class="w640" width="640" align="center" bgcolor="#425470">
               
               <div align="center" style="text-align: center">
                   <span style="position:relative; display:block"><span class="cs-fl-wrap" data-fillerimage="https://img.createsend1.com/static/filler/638x382_fill.gif" data-width="638" data-displayfiller="true" data-model="{&quot;label&quot;:null,&quot;type&quot;:&quot;im&quot;}" data-filename="Default"><img src="http://sia1.subirimagenes.net/img/2015/07/29/150729074713235356.jpg" width="638" height="134"border="0" align="top" style="display: inline"></span></span>    </div>
               
               
           </td>
                           </tr>
                           
                           <tr><td class="w640" width="640" height="30" bgcolor="#ffffff"></td></tr>
                           <tr id="gallery-content-row"><td class="w640" width="640" bgcolor="#ffffff">
               <table class="w640" width="640" cellpadding="0" cellspacing="0" border="0">
                   <tbody><tr>
                       <td class="w30" width="30"></td>
                       <td class="w580" width="580">
                           <span class="cs-rp-wrap" data-model="{&quot;Text only&quot;:{&quot;label&quot;:&quot;Text only&quot;,&quot;template&quot;:&quot;&lt;span class=\&quot;cs-it-wrap\&quot; data-layout=\&quot;Text only\&quot;&gt;&lt;span class=\&quot;cs-button-block\&quot;&gt;\r\n  &lt;span class=\&quot;cs-edit-content-button\&quot;&gt;&lt;/span&gt;\r\n  &lt;span class=\&quot;cs-delete-content-button\&quot;&gt;&lt;/span&gt;\r\n  &lt;span class=\&quot;cs-move-content-handle\&quot;&gt;&lt;/span&gt;\r\n  &lt;span class=\&quot;cs-add-new-dropdown\&quot;&gt;&lt;/span&gt;\r\n  \r\n&lt;/span&gt;\r\n                        &lt;table class=\&quot;w580\&quot; width=\&quot;580\&quot; cellpadding=\&quot;0\&quot; cellspacing=\&quot;0\&quot; border=\&quot;0\&quot;&gt;\r\n                            &lt;tbody&gt;&lt;tr&gt;\r\n                                &lt;td class=\&quot;w580\&quot; width=\&quot;580\&quot;&gt;\r\n                                    &lt;p align=\&quot;left\&quot; class=\&quot;article-title\&quot;&gt;&lt;span class=\&quot;cs-el-wrap\&quot;&gt;Add a title&lt;/span&gt;&lt;/p&gt;\r\n                                    &lt;div align=\&quot;left\&quot; class=\&quot;article-content\&quot;&gt;\r\n                                        &lt;span class=\&quot;cs-el-wrap\&quot;&gt;Enter your description&lt;/span&gt;\r\n                                    &lt;/div&gt;\r\n                                &lt;/td&gt;\r\n                            &lt;/tr&gt;\r\n                            &lt;tr&gt;&lt;td class=\&quot;w580\&quot; width=\&quot;580\&quot; height=\&quot;10\&quot;&gt;&lt;/td&gt;&lt;/tr&gt;\r\n                        &lt;/tbody&gt;&lt;/table&gt;\r\n                    &lt;/span&gt;&quot;,&quot;inTOC&quot;:false,&quot;regions&quot;:[{&quot;label&quot;:&quot;Title&quot;,&quot;type&quot;:&quot;sl&quot;,&quot;tocTitle&quot;:false},{&quot;label&quot;:&quot;Description&quot;,&quot;type&quot;:&quot;ml&quot;,&quot;tocTitle&quot;:false}]},&quot;Full width image&quot;:{&quot;label&quot;:&quot;Full width image&quot;,&quot;template&quot;:&quot;&lt;span class=\&quot;cs-it-wrap\&quot; data-layout=\&quot;Full width image\&quot;&gt;&lt;span class=\&quot;cs-button-block\&quot;&gt;\r\n  &lt;span class=\&quot;cs-edit-content-button\&quot;&gt;&lt;/span&gt;\r\n  &lt;span class=\&quot;cs-delete-content-button\&quot;&gt;&lt;/span&gt;\r\n  &lt;span class=\&quot;cs-move-content-handle\&quot;&gt;&lt;/span&gt;\r\n  &lt;span class=\&quot;cs-add-new-dropdown\&quot;&gt;&lt;/span&gt;\r\n  \r\n&lt;/span&gt;\r\n                        &lt;table class=\&quot;w580\&quot; width=\&quot;580\&quot; cellpadding=\&quot;0\&quot; cellspacing=\&quot;0\&quot; border=\&quot;0\&quot;&gt;\r\n                            &lt;tbody&gt;&lt;tr&gt;\r\n                                &lt;td class=\&quot;w580\&quot; width=\&quot;580\&quot; valign=\&quot;top\&quot;&gt;\r\n                                    &lt;table class=\&quot;w580\&quot; width=\&quot;580\&quot; cellpadding=\&quot;0\&quot; cellspacing=\&quot;0\&quot; border=\&quot;0\&quot;&gt;\r\n                                        &lt;tbody&gt;&lt;tr&gt;\r\n                                            &lt;td class=\&quot;w580\&quot; width=\&quot;580\&quot;&gt;&lt;span class=\&quot;cs-el-wrap\&quot; data-fillerimage=\&quot;https://img.createsend1.com/static/filler/580x348_fill.gif\&quot; data-width=\&quot;580\&quot;&gt;&lt;img editable=\&quot;true\&quot; label=\&quot;Image\&quot; class=\&quot;w580\&quot; width=\&quot;580\&quot; border=\&quot;0\&quot; src=\&quot;https://img.createsend1.com/static/filler/580x348_fill.gif\&quot; /&gt;&lt;/span&gt;&lt;/td&gt;\r\n                                        &lt;/tr&gt;\r\n                                        &lt;tr&gt;&lt;td class=\&quot;w580\&quot; width=\&quot;580\&quot; height=\&quot;10\&quot;&gt;&lt;/td&gt;&lt;/tr&gt;\r\n                                        &lt;tr&gt;\r\n                                            &lt;td class=\&quot;w580\&quot; width=\&quot;580\&quot;&gt;\r\n                                                &lt;div align=\&quot;center\&quot; class=\&quot;article-content\&quot;&gt;&lt;span class=\&quot;cs-el-wrap\&quot;&gt;Enter your description&lt;/span&gt;&lt;/div&gt;\r\n                                            &lt;/td&gt;\r\n                                        &lt;/tr&gt;\r\n                                        &lt;tr&gt;&lt;td class=\&quot;w580\&quot; width=\&quot;580\&quot; height=\&quot;10\&quot;&gt;&lt;/td&gt;&lt;/tr&gt;\r\n                                    &lt;/tbody&gt;&lt;/table&gt;\r\n                                &lt;/td&gt;\r\n                            &lt;/tr&gt;\r\n                        &lt;/tbody&gt;&lt;/table&gt;\r\n                    &lt;/span&gt;&quot;,&quot;inTOC&quot;:false,&quot;regions&quot;:[{&quot;label&quot;:&quot;Image&quot;,&quot;type&quot;:&quot;im&quot;,&quot;tocTitle&quot;:false},{&quot;label&quot;:&quot;Description&quot;,&quot;type&quot;:&quot;ml&quot;,&quot;tocTitle&quot;:false}]},&quot;Row of two images&quot;:{&quot;label&quot;:&quot;Row of two images&quot;,&quot;template&quot;:&quot;&lt;span class=\&quot;cs-it-wrap\&quot; data-layout=\&quot;Row of two images\&quot;&gt;&lt;span class=\&quot;cs-button-block\&quot;&gt;\r\n  &lt;span class=\&quot;cs-edit-content-button\&quot;&gt;&lt;/span&gt;\r\n  &lt;span class=\&quot;cs-delete-content-button\&quot;&gt;&lt;/span&gt;\r\n  &lt;span class=\&quot;cs-move-content-handle\&quot;&gt;&lt;/span&gt;\r\n  &lt;span class=\&quot;cs-add-new-dropdown\&quot;&gt;&lt;/span&gt;\r\n  \r\n&lt;/span&gt;\r\n                        &lt;table class=\&quot;w580\&quot; width=\&quot;580\&quot; cellpadding=\&quot;0\&quot; cellspacing=\&quot;0\&quot; border=\&quot;0\&quot;&gt;\r\n                            &lt;tbody&gt;&lt;tr&gt;\r\n                                &lt;td class=\&quot;w280\&quot; width=\&quot;280\&quot; valign=\&quot;top\&quot;&gt;\r\n                                    &lt;table class=\&quot;w280\&quot; width=\&quot;280\&quot; cellpadding=\&quot;0\&quot; cellspacing=\&quot;0\&quot; border=\&quot;0\&quot;&gt;\r\n                                        &lt;tbody&gt;&lt;tr&gt;\r\n                                            &lt;td class=\&quot;w280\&quot; width=\&quot;280\&quot;&gt;&lt;span class=\&quot;cs-el-wrap\&quot; data-fillerimage=\&quot;https://img.createsend1.com/static/filler/280x168_fill.gif\&quot; data-width=\&quot;280\&quot;&gt;&lt;img editable=\&quot;true\&quot; label=\&quot;Image\&quot; class=\&quot;w280\&quot; width=\&quot;280\&quot; border=\&quot;0\&quot; src=\&quot;https://img.createsend1.com/static/filler/280x168_fill.gif\&quot; /&gt;&lt;/span&gt;&lt;/td&gt;\r\n                                        &lt;/tr&gt;\r\n                                        &lt;tr&gt;&lt;td class=\&quot;w280\&quot; width=\&quot;280\&quot; height=\&quot;10\&quot;&gt;&lt;/td&gt;&lt;/tr&gt;\r\n                                        &lt;tr&gt;\r\n                                            &lt;td class=\&quot;w280\&quot; width=\&quot;280\&quot;&gt;\r\n                                                &lt;div align=\&quot;center\&quot; class=\&quot;article-content\&quot;&gt;&lt;span class=\&quot;cs-el-wrap\&quot;&gt;Enter your description&lt;/span&gt;&lt;/div&gt;\r\n                                            &lt;/td&gt;\r\n                                        &lt;/tr&gt;\r\n                                        &lt;tr&gt;&lt;td class=\&quot;w280\&quot; width=\&quot;280\&quot; height=\&quot;10\&quot;&gt;&lt;/td&gt;&lt;/tr&gt;\r\n                                    &lt;/tbody&gt;&lt;/table&gt;\r\n                                &lt;/td&gt;\r\n                                &lt;td width=\&quot;20\&quot;&gt;&lt;/td&gt;\r\n                                &lt;td class=\&quot;w280\&quot; width=\&quot;280\&quot; valign=\&quot;top\&quot;&gt;\r\n                                    &lt;table class=\&quot;w280\&quot; width=\&quot;280\&quot; cellpadding=\&quot;0\&quot; cellspacing=\&quot;0\&quot; border=\&quot;0\&quot;&gt;\r\n                                        &lt;tbody&gt;&lt;tr&gt;\r\n                                            &lt;td class=\&quot;w280\&quot; width=\&quot;280\&quot;&gt;&lt;span class=\&quot;cs-el-wrap\&quot; data-fillerimage=\&quot;https://img.createsend1.com/static/filler/280x168_fill.gif\&quot; data-width=\&quot;280\&quot;&gt;&lt;img editable=\&quot;true\&quot; label=\&quot;Image\&quot; class=\&quot;w280\&quot; width=\&quot;280\&quot; border=\&quot;0\&quot; src=\&quot;https://img.createsend1.com/static/filler/280x168_fill.gif\&quot; /&gt;&lt;/span&gt;&lt;/td&gt;\r\n                                        &lt;/tr&gt;\r\n                                        &lt;tr&gt;&lt;td class=\&quot;w280\&quot; width=\&quot;280\&quot; height=\&quot;10\&quot;&gt;&lt;/td&gt;&lt;/tr&gt;\r\n                                        &lt;tr&gt;\r\n                                            &lt;td class=\&quot;w280\&quot; width=\&quot;280\&quot;&gt;\r\n                                                &lt;div align=\&quot;center\&quot; class=\&quot;article-content\&quot;&gt;&lt;span class=\&quot;cs-el-wrap\&quot;&gt;Enter your description&lt;/span&gt;&lt;/div&gt;\r\n                                            &lt;/td&gt;\r\n                                        &lt;/tr&gt;\r\n                                        &lt;tr&gt;&lt;td class=\&quot;w280\&quot; width=\&quot;280\&quot; height=\&quot;10\&quot;&gt;&lt;/td&gt;&lt;/tr&gt;\r\n                                    &lt;/tbody&gt;&lt;/table&gt;\r\n                                &lt;/td&gt;\r\n                            &lt;/tr&gt;\r\n                        &lt;/tbody&gt;&lt;/table&gt;\r\n                    &lt;/span&gt;&quot;,&quot;inTOC&quot;:false,&quot;regions&quot;:[{&quot;label&quot;:&quot;Image&quot;,&quot;type&quot;:&quot;im&quot;,&quot;tocTitle&quot;:false},{&quot;label&quot;:&quot;Description&quot;,&quot;type&quot;:&quot;ml&quot;,&quot;tocTitle&quot;:false},{&quot;label&quot;:&quot;Image&quot;,&quot;type&quot;:&quot;im&quot;,&quot;tocTitle&quot;:false},{&quot;label&quot;:&quot;Description&quot;,&quot;type&quot;:&quot;ml&quot;,&quot;tocTitle&quot;:false}]},&quot;Row of three images&quot;:{&quot;label&quot;:&quot;Row of three images&quot;,&quot;template&quot;:&quot;&lt;span class=\&quot;cs-it-wrap\&quot; data-layout=\&quot;Row of three images\&quot;&gt;&lt;span class=\&quot;cs-button-block\&quot;&gt;\r\n  &lt;span class=\&quot;cs-edit-content-button\&quot;&gt;&lt;/span&gt;\r\n  &lt;span class=\&quot;cs-delete-content-button\&quot;&gt;&lt;/span&gt;\r\n  &lt;span class=\&quot;cs-move-content-handle\&quot;&gt;&lt;/span&gt;\r\n  &lt;span class=\&quot;cs-add-new-dropdown\&quot;&gt;&lt;/span&gt;\r\n  \r\n&lt;/span&gt;\r\n                        &lt;table class=\&quot;w580\&quot; width=\&quot;580\&quot; cellpadding=\&quot;0\&quot; cellspacing=\&quot;0\&quot; border=\&quot;0\&quot;&gt;\r\n                            &lt;tbody&gt;&lt;tr&gt;\r\n                                &lt;td class=\&quot;w180\&quot; width=\&quot;180\&quot; valign=\&quot;top\&quot;&gt;\r\n                                    &lt;table class=\&quot;w180\&quot; width=\&quot;180\&quot; cellpadding=\&quot;0\&quot; cellspacing=\&quot;0\&quot; border=\&quot;0\&quot;&gt;\r\n                                        &lt;tbody&gt;&lt;tr&gt;\r\n                                            &lt;td class=\&quot;w180\&quot; width=\&quot;180\&quot;&gt;&lt;span class=\&quot;cs-el-wrap\&quot; data-fillerimage=\&quot;https://img.createsend1.com/static/filler/180x108_fill.gif\&quot; data-width=\&quot;180\&quot;&gt;&lt;img editable=\&quot;true\&quot; label=\&quot;Image\&quot; class=\&quot;w180\&quot; width=\&quot;180\&quot; border=\&quot;0\&quot; src=\&quot;https://img.createsend1.com/static/filler/180x108_fill.gif\&quot; /&gt;&lt;/span&gt;&lt;/td&gt;\r\n                                        &lt;/tr&gt;\r\n                                        &lt;tr&gt;&lt;td class=\&quot;w180\&quot; width=\&quot;180\&quot; height=\&quot;10\&quot;&gt;&lt;/td&gt;&lt;/tr&gt;\r\n                                        &lt;tr&gt;\r\n                                            &lt;td class=\&quot;w180\&quot; width=\&quot;180\&quot;&gt;\r\n                                                &lt;div align=\&quot;center\&quot; class=\&quot;article-content\&quot;&gt;&lt;span class=\&quot;cs-el-wrap\&quot;&gt;Enter your description&lt;/span&gt;&lt;/div&gt;\r\n                                            &lt;/td&gt;\r\n                                        &lt;/tr&gt;\r\n                                        &lt;tr&gt;&lt;td class=\&quot;w180\&quot; width=\&quot;180\&quot; height=\&quot;10\&quot;&gt;&lt;/td&gt;&lt;/tr&gt;\r\n                                    &lt;/tbody&gt;&lt;/table&gt;\r\n                                &lt;/td&gt;\r\n                                &lt;td width=\&quot;20\&quot;&gt;&lt;/td&gt;\r\n                                &lt;td class=\&quot;w180\&quot; width=\&quot;180\&quot; valign=\&quot;top\&quot;&gt;\r\n                                    &lt;table class=\&quot;w180\&quot; width=\&quot;180\&quot; cellpadding=\&quot;0\&quot; cellspacing=\&quot;0\&quot; border=\&quot;0\&quot;&gt;\r\n                                        &lt;tbody&gt;&lt;tr&gt;\r\n                                            &lt;td class=\&quot;w180\&quot; width=\&quot;180\&quot;&gt;&lt;span class=\&quot;cs-el-wrap\&quot; data-fillerimage=\&quot;https://img.createsend1.com/static/filler/180x108_fill.gif\&quot; data-width=\&quot;180\&quot;&gt;&lt;img editable=\&quot;true\&quot; label=\&quot;Image\&quot; class=\&quot;w180\&quot; width=\&quot;180\&quot; border=\&quot;0\&quot; src=\&quot;https://img.createsend1.com/static/filler/180x108_fill.gif\&quot; /&gt;&lt;/span&gt;&lt;/td&gt;\r\n                                        &lt;/tr&gt;\r\n                                        &lt;tr&gt;&lt;td class=\&quot;w180\&quot; width=\&quot;180\&quot; height=\&quot;10\&quot;&gt;&lt;/td&gt;&lt;/tr&gt;\r\n                                        &lt;tr&gt;\r\n                                            &lt;td class=\&quot;w180\&quot; width=\&quot;180\&quot;&gt;\r\n                                                &lt;div align=\&quot;center\&quot; class=\&quot;article-content\&quot;&gt;&lt;span class=\&quot;cs-el-wrap\&quot;&gt;Enter your description&lt;/span&gt;&lt;/div&gt;\r\n                                            &lt;/td&gt;\r\n                                        &lt;/tr&gt;\r\n                                        &lt;tr&gt;&lt;td class=\&quot;w180\&quot; width=\&quot;180\&quot; height=\&quot;10\&quot;&gt;&lt;/td&gt;&lt;/tr&gt;\r\n                                    &lt;/tbody&gt;&lt;/table&gt;\r\n                                &lt;/td&gt;\r\n                                &lt;td width=\&quot;20\&quot;&gt;&lt;/td&gt;\r\n                                &lt;td class=\&quot;w180\&quot; width=\&quot;180\&quot; valign=\&quot;top\&quot;&gt;\r\n                                    &lt;table class=\&quot;w180\&quot; width=\&quot;180\&quot; cellpadding=\&quot;0\&quot; cellspacing=\&quot;0\&quot; border=\&quot;0\&quot;&gt;\r\n                                        &lt;tbody&gt;&lt;tr&gt;\r\n                                            &lt;td class=\&quot;w180\&quot; width=\&quot;180\&quot;&gt;&lt;span class=\&quot;cs-el-wrap\&quot; data-fillerimage=\&quot;https://img.createsend1.com/static/filler/180x108_fill.gif\&quot; data-width=\&quot;180\&quot;&gt;&lt;img editable=\&quot;true\&quot; label=\&quot;Image\&quot; class=\&quot;w180\&quot; width=\&quot;180\&quot; border=\&quot;0\&quot; src=\&quot;https://img.createsend1.com/static/filler/180x108_fill.gif\&quot; /&gt;&lt;/span&gt;&lt;/td&gt;\r\n                                        &lt;/tr&gt;\r\n                                        &lt;tr&gt;&lt;td class=\&quot;w180\&quot; width=\&quot;180\&quot; height=\&quot;10\&quot;&gt;&lt;/td&gt;&lt;/tr&gt;\r\n                                        &lt;tr&gt;\r\n                                            &lt;td class=\&quot;w180\&quot; width=\&quot;180\&quot;&gt;\r\n                                                &lt;div align=\&quot;center\&quot; class=\&quot;article-content\&quot;&gt;&lt;span class=\&quot;cs-el-wrap\&quot;&gt;Enter your description&lt;/span&gt;&lt;/div&gt;\r\n                                            &lt;/td&gt;\r\n                                        &lt;/tr&gt;\r\n                                        &lt;tr&gt;&lt;td class=\&quot;w180\&quot; width=\&quot;180\&quot; height=\&quot;10\&quot;&gt;&lt;/td&gt;&lt;/tr&gt;\r\n                                    &lt;/tbody&gt;&lt;/table&gt;\r\n                                &lt;/td&gt;\r\n                            &lt;/tr&gt;\r\n                        &lt;/tbody&gt;&lt;/table&gt;\r\n                    &lt;/span&gt;&quot;,&quot;inTOC&quot;:false,&quot;regions&quot;:[{&quot;label&quot;:&quot;Image&quot;,&quot;type&quot;:&quot;im&quot;,&quot;tocTitle&quot;:false},{&quot;label&quot;:&quot;Description&quot;,&quot;type&quot;:&quot;ml&quot;,&quot;tocTitle&quot;:false},{&quot;label&quot;:&quot;Image&quot;,&quot;type&quot;:&quot;im&quot;,&quot;tocTitle&quot;:false},{&quot;label&quot;:&quot;Description&quot;,&quot;type&quot;:&quot;ml&quot;,&quot;tocTitle&quot;:false},{&quot;label&quot;:&quot;Image&quot;,&quot;type&quot;:&quot;im&quot;,&quot;tocTitle&quot;:false},{&quot;label&quot;:&quot;Description&quot;,&quot;type&quot;:&quot;ml&quot;,&quot;tocTitle&quot;:false}]},&quot;Row of four images&quot;:{&quot;label&quot;:&quot;Row of four images&quot;,&quot;template&quot;:&quot;&lt;span class=\&quot;cs-it-wrap\&quot; data-layout=\&quot;Row of four images\&quot;&gt;&lt;span class=\&quot;cs-button-block\&quot;&gt;\r\n  &lt;span class=\&quot;cs-edit-content-button\&quot;&gt;&lt;/span&gt;\r\n  &lt;span class=\&quot;cs-delete-content-button\&quot;&gt;&lt;/span&gt;\r\n  &lt;span class=\&quot;cs-move-content-handle\&quot;&gt;&lt;/span&gt;\r\n  &lt;span class=\&quot;cs-add-new-dropdown\&quot;&gt;&lt;/span&gt;\r\n  \r\n&lt;/span&gt;\r\n                        &lt;table class=\&quot;w580\&quot; width=\&quot;580\&quot; cellpadding=\&quot;0\&quot; cellspacing=\&quot;0\&quot; border=\&quot;0\&quot;&gt;\r\n                            &lt;tbody&gt;&lt;tr&gt;\r\n                                &lt;td class=\&quot;w130\&quot; width=\&quot;130\&quot; valign=\&quot;top\&quot;&gt;\r\n                                    &lt;table class=\&quot;w130\&quot; width=\&quot;130\&quot; cellpadding=\&quot;0\&quot; cellspacing=\&quot;0\&quot; border=\&quot;0\&quot;&gt;\r\n                                        &lt;tbody&gt;&lt;tr&gt;\r\n                                            &lt;td class=\&quot;w130\&quot; width=\&quot;130\&quot;&gt;&lt;span class=\&quot;cs-el-wrap\&quot; data-fillerimage=\&quot;https://img.createsend1.com/static/filler/130x78_fill.gif\&quot; data-width=\&quot;130\&quot;&gt;&lt;img editable=\&quot;true\&quot; label=\&quot;Image\&quot; class=\&quot;w130\&quot; width=\&quot;130\&quot; border=\&quot;0\&quot; src=\&quot;https://img.createsend1.com/static/filler/130x78_fill.gif\&quot; /&gt;&lt;/span&gt;&lt;/td&gt;\r\n                                        &lt;/tr&gt;\r\n                                        &lt;tr&gt;&lt;td class=\&quot;w130\&quot; width=\&quot;130\&quot; height=\&quot;10\&quot;&gt;&lt;/td&gt;&lt;/tr&gt;\r\n                                        &lt;tr&gt;\r\n                                            &lt;td class=\&quot;w130\&quot; width=\&quot;130\&quot;&gt;\r\n                                                &lt;div align=\&quot;center\&quot; class=\&quot;article-content\&quot;&gt;&lt;span class=\&quot;cs-el-wrap\&quot;&gt;Enter your description&lt;/span&gt;&lt;/div&gt;\r\n                                            &lt;/td&gt;\r\n                                        &lt;/tr&gt;\r\n                                        &lt;tr&gt;&lt;td class=\&quot;w130\&quot; width=\&quot;130\&quot; height=\&quot;10\&quot;&gt;&lt;/td&gt;&lt;/tr&gt;\r\n                                    &lt;/tbody&gt;&lt;/table&gt;\r\n                                &lt;/td&gt;\r\n                                &lt;td width=\&quot;20\&quot;&gt;&lt;/td&gt;\r\n                                &lt;td class=\&quot;w130\&quot; width=\&quot;130\&quot; valign=\&quot;top\&quot;&gt;\r\n                                    &lt;table class=\&quot;w130\&quot; width=\&quot;130\&quot; cellpadding=\&quot;0\&quot; cellspacing=\&quot;0\&quot; border=\&quot;0\&quot;&gt;\r\n                                        &lt;tbody&gt;&lt;tr&gt;\r\n                                            &lt;td class=\&quot;w130\&quot; width=\&quot;130\&quot;&gt;&lt;span class=\&quot;cs-el-wrap\&quot; data-fillerimage=\&quot;https://img.createsend1.com/static/filler/130x78_fill.gif\&quot; data-width=\&quot;130\&quot;&gt;&lt;img editable=\&quot;true\&quot; label=\&quot;Image\&quot; class=\&quot;w130\&quot; width=\&quot;130\&quot; border=\&quot;0\&quot; src=\&quot;https://img.createsend1.com/static/filler/130x78_fill.gif\&quot; /&gt;&lt;/span&gt;&lt;/td&gt;\r\n                                        &lt;/tr&gt;\r\n                                        &lt;tr&gt;&lt;td class=\&quot;w130\&quot; width=\&quot;130\&quot; height=\&quot;10\&quot;&gt;&lt;/td&gt;&lt;/tr&gt;\r\n                                        &lt;tr&gt;\r\n                                            &lt;td class=\&quot;w130\&quot; width=\&quot;130\&quot;&gt;\r\n                                                &lt;div align=\&quot;center\&quot; class=\&quot;article-content\&quot;&gt;&lt;span class=\&quot;cs-el-wrap\&quot;&gt;Enter your description&lt;/span&gt;&lt;/div&gt;\r\n                                            &lt;/td&gt;\r\n                                        &lt;/tr&gt;\r\n                                        &lt;tr&gt;&lt;td class=\&quot;w130\&quot; width=\&quot;130\&quot; height=\&quot;10\&quot;&gt;&lt;/td&gt;&lt;/tr&gt;\r\n                                    &lt;/tbody&gt;&lt;/table&gt;\r\n                                &lt;/td&gt;\r\n                                &lt;td width=\&quot;20\&quot;&gt;&lt;/td&gt;\r\n                                &lt;td class=\&quot;w130\&quot; width=\&quot;130\&quot; valign=\&quot;top\&quot;&gt;\r\n                                    &lt;table class=\&quot;w130\&quot; width=\&quot;130\&quot; cellpadding=\&quot;0\&quot; cellspacing=\&quot;0\&quot; border=\&quot;0\&quot;&gt;\r\n                                        &lt;tbody&gt;&lt;tr&gt;\r\n                                            &lt;td class=\&quot;w130\&quot; width=\&quot;130\&quot;&gt;&lt;span class=\&quot;cs-el-wrap\&quot; data-fillerimage=\&quot;https://img.createsend1.com/static/filler/130x78_fill.gif\&quot; data-width=\&quot;130\&quot;&gt;&lt;img editable=\&quot;true\&quot; label=\&quot;Image\&quot; class=\&quot;w130\&quot; width=\&quot;130\&quot; border=\&quot;0\&quot; src=\&quot;https://img.createsend1.com/static/filler/130x78_fill.gif\&quot; /&gt;&lt;/span&gt;&lt;/td&gt;\r\n                                        &lt;/tr&gt;\r\n                                        &lt;tr&gt;&lt;td class=\&quot;w130\&quot; width=\&quot;130\&quot; height=\&quot;10\&quot;&gt;&lt;/td&gt;&lt;/tr&gt;\r\n                                        &lt;tr&gt;\r\n                                            &lt;td class=\&quot;w130\&quot; width=\&quot;130\&quot;&gt;\r\n                                                &lt;div align=\&quot;center\&quot; class=\&quot;article-content\&quot;&gt;&lt;span class=\&quot;cs-el-wrap\&quot;&gt;Enter your description&lt;/span&gt;&lt;/div&gt;\r\n                                            &lt;/td&gt;\r\n                                        &lt;/tr&gt;\r\n                                        &lt;tr&gt;&lt;td class=\&quot;w130\&quot; width=\&quot;130\&quot; height=\&quot;10\&quot;&gt;&lt;/td&gt;&lt;/tr&gt;\r\n                                    &lt;/tbody&gt;&lt;/table&gt;\r\n                                &lt;/td&gt;\r\n                                &lt;td width=\&quot;20\&quot;&gt;&lt;/td&gt;\r\n                                &lt;td class=\&quot;w130\&quot; width=\&quot;130\&quot; valign=\&quot;top\&quot;&gt;\r\n                                    &lt;table class=\&quot;w130\&quot; width=\&quot;130\&quot; cellpadding=\&quot;0\&quot; cellspacing=\&quot;0\&quot; border=\&quot;0\&quot;&gt;\r\n                                        &lt;tbody&gt;&lt;tr&gt;\r\n                                            &lt;td class=\&quot;w130\&quot; width=\&quot;130\&quot;&gt;&lt;span class=\&quot;cs-el-wrap\&quot; data-fillerimage=\&quot;https://img.createsend1.com/static/filler/130x78_fill.gif\&quot; data-width=\&quot;130\&quot;&gt;&lt;img editable=\&quot;true\&quot; label=\&quot;Image\&quot; class=\&quot;w130\&quot; width=\&quot;130\&quot; border=\&quot;0\&quot; src=\&quot;https://img.createsend1.com/static/filler/130x78_fill.gif\&quot; /&gt;&lt;/span&gt;&lt;/td&gt;\r\n                                        &lt;/tr&gt;\r\n                                        &lt;tr&gt;&lt;td class=\&quot;w130\&quot; width=\&quot;130\&quot; height=\&quot;10\&quot;&gt;&lt;/td&gt;&lt;/tr&gt;\r\n                                        &lt;tr&gt;\r\n                                            &lt;td class=\&quot;w130\&quot; width=\&quot;130\&quot;&gt;\r\n                                                &lt;div align=\&quot;center\&quot; class=\&quot;article-content\&quot;&gt;&lt;span class=\&quot;cs-el-wrap\&quot;&gt;Enter your description&lt;/span&gt;&lt;/div&gt;\r\n                                            &lt;/td&gt;\r\n                                        &lt;/tr&gt;\r\n                                        &lt;tr&gt;&lt;td class=\&quot;w130\&quot; width=\&quot;130\&quot; height=\&quot;10\&quot;&gt;&lt;/td&gt;&lt;/tr&gt;\r\n                                    &lt;/tbody&gt;&lt;/table&gt;\r\n                                &lt;/td&gt;\r\n                            &lt;/tr&gt;\r\n                        &lt;/tbody&gt;&lt;/table&gt;\r\n                    &lt;/span&gt;&quot;,&quot;inTOC&quot;:false,&quot;regions&quot;:[{&quot;label&quot;:&quot;Image&quot;,&quot;type&quot;:&quot;im&quot;,&quot;tocTitle&quot;:false},{&quot;label&quot;:&quot;Description&quot;,&quot;type&quot;:&quot;ml&quot;,&quot;tocTitle&quot;:false},{&quot;label&quot;:&quot;Image&quot;,&quot;type&quot;:&quot;im&quot;,&quot;tocTitle&quot;:false},{&quot;label&quot;:&quot;Description&quot;,&quot;type&quot;:&quot;ml&quot;,&quot;tocTitle&quot;:false},{&quot;label&quot;:&quot;Image&quot;,&quot;type&quot;:&quot;im&quot;,&quot;tocTitle&quot;:false},{&quot;label&quot;:&quot;Description&quot;,&quot;type&quot;:&quot;ml&quot;,&quot;tocTitle&quot;:false},{&quot;label&quot;:&quot;Image&quot;,&quot;type&quot;:&quot;im&quot;,&quot;tocTitle&quot;:false},{&quot;label&quot;:&quot;Description&quot;,&quot;type&quot;:&quot;ml&quot;,&quot;tocTitle&quot;:false}]}}"><span class="cs-it-wrap" data-layout="Text only">
                         <table class="w580" width="580" cellpadding="0" cellspacing="0" border="0">
                                       <tbody><tr>
                                           <td class="w580" width="580">
                                               <p align="left" class="article-title"><span style="font-size: 18px; line-height: 24px; color: #C25130; font-weight: bold; font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;">'.$titulo.'</span></p>
                                               <div align="left" class="article-content">
                                                   <span style="font-size: 14px; line-height: 18px; color: #444; font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;">'.$contenido.'</span>
                                               </div>
                                           </td>
                                       </tr>
                                       <tr><td class="w580" width="580" height="10"></td></tr>
                                   </tbody></table>
                               </span></span>
                       </td>
                       <td class="w30" width="30"></td>
                   </tr>
               </tbody></table>
           </td></tr>
                           <tr><td class="w640" width="640" height="15" bgcolor="#ffffff"></td></tr>
                           
                           <tr>
                           <td class="w640" width="640">
                   </td>
                   </tr>
           </tbody></table><img src="o.gif" style="height:1px !important; width:1px !important; border: 0 !important; margin: 0 !important; padding: 0 !important" width="1" height="1" border="0">
           </body>
           </html>';
     
            
            return $html;		
        }
   
}

?>