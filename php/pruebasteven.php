<?php
require_once '../lib/connection.php';

global $conn;
        
                /*$sql="
SELECT emp.cod_emp AS COD_EMP, emp.nom_emp AS NOM_EMP,emp.dir_emp AS DIR_EMP,emp.nit_emp AS NIT_EMP,emp.digito_ver AS DIGITO_VER,ciu.cod_ciu_iss AS COD_CIU_ISS,ciu.cod_dpt AS COD_DPT,ciu.nom_ciu AS NOM_CIU,depa.nom_dpt AS NOM_DPT,tel_1 AS TEL_1 
FROM empresas emp,ciudades ciu,dpto_pais depa 
WHERE emp.cod_ciu=ciu.cod_ciu
                           AND ciu.cod_dpt=depa.cod_dpt                        
						AND cod_emp in(select cod_emp from empleados_basic where cod_epl='11232014')";*/
                
				$sql="SELECT cod_epl, cod_emp, estado FROM empleados_basic where cod_epl='1013587830'";
				
                $res=$conn->Execute($sql);

echo "<table border='1'>";

while($reg= $res->FetchRow())
{
        
        echo "<tr>";
        foreach($reg as $key => $value){ 
                
                        echo '<td>'.$key.'</td>';
                
        }
        echo "</tr>";
        
        
        echo "<tr>";
        foreach($reg as $key => $value){ 
                
                        echo '<td>'.$value.'</td>';
                
        }
        echo "</tr>";
}

echo "</table>";

?>