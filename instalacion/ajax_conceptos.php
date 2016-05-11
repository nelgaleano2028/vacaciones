<?php
    include_once("../lib/connection.php");
    include_once("../lib/configdb.php");
    
    global $is_connect, $conn;
    
    
    if($is_connect == true){
    
    if($_POST['host'] != null && $_POST['usuario'] != null &&  $_POST['pass'] != null &&  $_POST['email'] != null ){
        
   
    /* 
      .------------------------------------------------.
      * PARAMETROS  DEL SERVIDOR DE CORREO ELECTRONICO *
      * HOST  DEL SERVER                               *
      * USUARIO                                        * 
      * PASSWORD                                       * 
      * CORREO DE QUIEN ENVIA                          *
      .-----------------------------------------------.                                                 
      
    */
    /*--host de server de correo--------*/
    $existe="Select nom_var as NOM_VAR from parametros_nue where nom_var='chc_servidor_correo'";
            $ver=$conn->Execute($existe);
               $fila=@$ver->FetchRow();
               
             
            if($fila["NOM_VAR"] != 'chc_servidor_correo'){
            $correo = "insert into parametros_nue (nom_var,des_var,tip_var,descripcion) 
                      values ('chc_servidor_correo'
                              ,'SERVIDOR DE CORREO CHEC'
                              ,'C'
                              ,'".$_POST['host']."')";
                              
           $query = $conn->Execute($correo);
    }else{
        $conn->BeginTrans();
        $update="update parametros_nue set descripcion='".$_POST["host"]."' where nom_var='chc_servidor_correo'";
        $execute=$conn->Execute($update);
        $conn->CommitTrans();
    }
    $existe= null;
    $fila = null;
    $update = null;
    $execute = null;
    $ver = null;
    /*--------------------------*/    
    
    /*--usuario de conexion al server de correo--------*/
    
     $existe="Select nom_var as NOM_VAR from parametros_nue where nom_var='chc_usuario_correo'";
            $ver=$conn->Execute($existe);
               $fila=@$ver->FetchRow();
               
             
            if($fila["NOM_VAR"] != 'chc_usuario_correo'){
    $correo2 = "insert into parametros_nue (nom_var,des_var,tip_var,descripcion) 
    values ('chc_usuario_correo'
            ,'PASSWORD PARA AUTENTICACION EN SERVIDOR DE CORREO'
            ,'C'
            ,'".$_POST['usuario']."')";
    $query2 = $conn->Execute($correo2);
            }else{
        $conn->BeginTrans();
        $update="update parametros_nue set descripcion='".$_POST["usuario"]."' where nom_var='chc_usuario_correo'";
        $execute=$conn->Execute($update);
        $conn->CommitTrans();
    }
    $existe= null;
    $fila = null;
    $update = null;
    $execute = null;
    $ver = null;
    /*--------------------------*/    
    
    /*--contraseña de conexion al server de correo-------*/
      $existe="Select nom_var as NOM_VAR from parametros_nue where nom_var='chc_password_correo'";
            $ver=$conn->Execute($existe);
               $fila=@$ver->FetchRow();
               
             
            if($fila["NOM_VAR"] != 'chc_password_correo'){
   $correo3 = "insert into parametros_nue (nom_var,des_var,tip_var,descripcion) 
    values ('chc_password_correo',
            'PASSWORD PARA AUTENTICACION EN SERVIDOR DE CORREO',
            'C',
            '".$_POST['pass']."')";
    $query3 = $conn->Execute($correo3);
            }else{
        $conn->BeginTrans();
        $update="update parametros_nue set descripcion='".$_POST["pass"]."' where nom_var='chc_password_correo'";
        $execute=$conn->Execute($update);
        $conn->CommitTrans();
    }
    $existe= null;
    $fila = null;
    $update = null;
    $execute = null;
    $ver = null;
    /*--------------------------*/    
    
    
    /*--Correo empresarial de server quien envia -------*/
    
    $existe="Select nom_var as NOM_VAR from parametros_nue where nom_var='chc_remitente_correo'";
            $ver=$conn->Execute($existe);
               $fila=@$ver->FetchRow();
               
             
            if($fila["NOM_VAR"] != 'chc_remitente_correo'){
    $correo4 = "insert into parametros_nue (nom_var,des_var,tip_var,descripcion) 
    values ('chc_remitente_correo'
            ,'USUARIO REMITENTE DE CORREO'
            ,'C'
            ,'".$_POST['email']."')";
    $query4 = $conn->Execute($correo4);
            }else{
        $conn->BeginTrans();
        $update="update parametros_nue set descripcion='".$_POST["email"]."' where nom_var='chc_remitente_correo'";
        $execute=$conn->Execute($update);
        $conn->CommitTrans();
    }
    
    $existe= null;
    $fila = null;
    $update = null;
    $execute = null;
    $ver = null;
    /*--------------------------*/    
     
     
    }
   
    if($_POST['liq_quin'] != "" && $_POST['pag_quin'] != "" ){
    /* 
      .--------------------------------------------------.
      * PARAMETROS  DE CONCEPTOS DE CADA EMPRESA        *
      * LIQUIDACION                                     *
      * TIPO DE PAGO                                    * 
      *                                                 *
      *ESTOS DATOS VARIAN POR CADA EMPRESA              * 
      *                                                 *
      .-------------------------------------------------.                                                 
      
    */
    
    /*-----QUINCENAL------*/
      $existe="Select nom_var as NOM_VAR from parametros_nue where nom_var='param_quince_liq'";
            $ver=$conn->Execute($existe);
               $fila=@$ver->FetchRow();
               
             
            if($fila["NOM_VAR"] != 'param_quince_liq'){
    /*--Concepto de liquidacion Quincenal de la empresa -------*/
    
    $quin = "insert into parametros_nue (nom_var,des_var,tip_var,descripcion) 
    values ('param_quince_liq'
            ,'LIQUIDACION QUINCENAL'
            ,'N'
            ,'".$_POST["liq_quin"]."')";
    $query_quin = $conn->Execute($quin);
    }else{
        $conn->BeginTrans();
        $update="update parametros_nue set descripcion='".$_POST["liq_quin"]."' where nom_var='param_quince_liq'";
        $execute=$conn->Execute($update);
        $conn->CommitTrans();
    }
    $existe= null;
    $fila = null;
    $update = null;
    $execute = null;
    $ver = null;
    /*--------------------------*/    
    
    /*--Concepto de TIPO DE PAGO de la empresa -------*/
    
    $existe="Select nom_var as NOM_VAR from parametros_nue where nom_var='param_quince_tip_pag'";
            $ver=$conn->Execute($existe);
               $fila=@$ver->FetchRow();
               
             
            if($fila["NOM_VAR"] != 'param_quince_tip_pag'){
    $quin2="insert into parametros_nue (nom_var,des_var,tip_var,descripcion) values ('param_quince_tip_pag','TIPO DE PAGO QUINCENAL','N','".$_POST['pag_quin']."')";
    $query_quin2 = $conn->Execute($quin2);
            }else{
        $conn->BeginTrans();
        $update="update parametros_nue set descripcion='".$_POST["pag_quin"]."' where nom_var='param_quince_tip_pag'";
        $execute=$conn->Execute($update);
        $conn->CommitTrans();
    }
    
    $existe= null;
    $fila = null;
    $update = null;
    $execute = null;
    $ver = null;
    /*--------------------------*/    
    
    }
   
   
   
 
    
    if($_POST['liq_men'] != "" && $_POST['pag_men'] != "" ){
    
    /*-----MENSUAL------*/
    
    $existe1="Select nom_var as NOM_VAR from parametros_nue where nom_var='param_mensual_liq'";
            $ver1=$conn->Execute($existe1);
               $fila1=$ver1->FetchRow();
               
             
            if($fila1["NOM_VAR"] != 'param_mensual_liq'){
    
    /*--Concepto de liquidacion MENSUAL de la empresa -------*/
    $men = "insert into parametros_nue (nom_var,des_var,tip_var,descripcion) values ('param_mensual_liq','LIQUIDACION MENSUAL','N','".$_POST["liq_men"]."')";
    $query_men = $conn->Execute($men);
            }else{
        $conn->BeginTrans();
        $update="update parametros_nue set descripcion='".$_POST["liq_men"]."' where nom_var='param_mensual_liq'";
        $execute=$conn->Execute($update);
        $conn->CommitTrans();
    }

    /*--------------------------*/    
    
    /*--Concepto de TIPO DE PAGO de la empresa -------*/
    
    $sql = "select nom_var as NOM_VAR from parametros_nue where nom_var = 'param_mens_tipag'";
            $rs=$conn->Execute($sql);
            $fila2=$rs->FetchRow();
            $cantidad=count($fila2['NOM_VAR']);
               
             
            if($cantidad == 0){
    $insert="insert into parametros_nue (nom_var,des_var,tip_var,descripcion) values ('param_mens_tipag','TIPO DE PAGO MENSUAL','N','".$_POST["pag_men"]."')";
    $ejecutar= $conn->Execute($insert);
            }else{
        $conn->BeginTrans();
        $update2="update parametros_nue set DESCRIPCION='".$_POST["pag_men"]."' where nom_var = 'param_mens_tipag'";
    $actualizar=$conn->Execute($update2);
    $conn->CommitTrans();
    }

    /*--------------------------    */
    }
    
    if($_POST['liq_sem'] != "" && $_POST['pag_sem'] != "" ){
    /*-----SEMANAL------*/
    
    $existe="Select nom_var as NOM_VAR from parametros_nue where nom_var='param_semanal_liq'";
            $ver=$conn->Execute($existe);
               $fila=@$ver->FetchRow();
               
             
            if($fila["NOM_VAR"] != 'param_semanal_liq'){
    
    /*--Concepto de liquidacion SEMANAL de la empresa -------*/
    $seman = "insert into parametros_nue (nom_var,des_var,tip_var,descripcion) 
    values ('param_semanal_liq'
            ,'LIQUIDACION SEMANAL'
            ,'N'
            ,'".$_POST['liq_sem']."')";
    $query_seman = $conn->Execute($seman);
            }else{
        $conn->BeginTrans();
        $update="update parametros_nue set descripcion='".$_POST["liq_sem"]."' where nom_var='param_semanal_liq'";
        $execute=$conn->Execute($update);
        $conn->CommitTrans();
    }
    
    $existe= null;
    $fila = null;
    $update = null;
    $execute = null;
    $ver = null;
    /*--------------------------    */
    
    /*--Concepto de TIPO DE PAGO de la empresa -------*/
    
    $existe="Select nom_var as NOM_VAR from parametros_nue where nom_var='param_sema_tip_pag'";
            $ver=$conn->Execute($existe);
               $fila=@$ver->FetchRow();
               
             
            if($fila["NOM_VAR"] != 'param_sema_tip_pag'){
    $seman2 = "insert into parametros_nue (nom_var,des_var,tip_var,descripcion) 
    values ('param_sema_tip_pag'
            ,'TIPO DE PAGO SEMANAL'
            ,'N'
            ,'".$_POST['pag_sem']."')";
    $query_seman2 = $conn->Execute($seman2);
            }else{
        $conn->BeginTrans();
        $update="update parametros_nue set descripcion='".$_POST["pag_sem"]."' where nom_var='param_sema_tip_pag'";
        $execute=$conn->Execute($update);
        $conn->CommitTrans();
    }
    
    $existe= null;
    $fila = null;
    $update = null;
    $execute = null;
    $ver = null;
    /*--------------------------    */
      
    }
    
    
    
    if($_POST['vac_con'] != "" && $_POST['vac_aus'] != "" ){
    /* 
      .--------------------------------------------------.
      * PARAMETROS  DE CONCEPTOS DE CADA EMPRESA        *
      * VACACIONES DISFRUTADAS                          *
      * CODIGO DE AUSENCIA DE VACACIONES                * 
      *                                                 *
      *ESTOS DATOS VARIAN POR CADA EMPRESA              * 
      *                                                 *
      .-------------------------------------------------.                                                 
      
    */
    
    
     /* -----VACACIONES-----*/
     
     $existe="Select nom_var as NOM_VAR from parametros_nue where nom_var='param_vacas_cod_con'";
            $ver=$conn->Execute($existe);
               $fila=@$ver->FetchRow();
               
             
            if($fila["NOM_VAR"] != 'param_vacas_cod_con'){
    
    /*--Concepto de VACACIONES DISFRUTADAS de la empresa -------*/
    $vacaciones = "insert into parametros_nue (nom_var,des_var,tip_var,descripcion) 
    values ('param_vacas_cod_con'
            ,'CONCEPTO DE VACACIONES DISFRUTADAS'
            ,'N'
            ,'".$_POST['vac_con']."')";
    $query_vacas = $conn->Execute($vacaciones);
            }else{
        $conn->BeginTrans();
        $update="update parametros_nue set descripcion='".$_POST["vac_con"]."' where nom_var='param_vacas_cod_con'";
        $execute=$conn->Execute($update);
        $conn->CommitTrans();
    }
    
    $existe= null;
    $fila = null;
    $update = null;
    $execute = null;
    $ver = null;
    /*--------------------------    */
    
    /*--Concepto de CODIGO DE AUSENCIA DE VACACIONES de la empresa -------*/
    
    $existe="Select nom_var as NOM_VAR from parametros_nue where nom_var='param_vacas_cod_aus'";
            $ver=$conn->Execute($existe);
               $fila=@$ver->FetchRow();
               
             
            if($fila["NOM_VAR"] != 'param_vacas_cod_aus'){
    $vacaciones2 = "insert into parametros_nue (nom_var,des_var,tip_var,descripcion) 
    values ('param_vacas_cod_aus'
            ,'CODIGO DE AUSENCIA DE VACACIONES'
            ,'N'
            ,'".$_POST['vac_aus']."')";
    $query_vacas2 = $conn->Execute($vacaciones2);
    
    }else{
        $conn->BeginTrans();
        $update="update parametros_nue set descripcion='".$_POST["vac_aus"]."' where nom_var='param_vacas_cod_aus'";
        $execute=$conn->Execute($update);
        $conn->CommitTrans();
    }
    
    $existe= null;
    $fila = null;
    $update = null;
    $execute = null;
    $ver = null;
    
    /*--------------------------   */
    }
    
     
  echo "Se termino la instalacion satisfactoriamente";
    
    
      
    
    
    }else{
        echo "No hay conexion con la base de datos";
    }

?>