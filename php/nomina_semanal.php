 <table width="100%">
                        <caption style="font-weight:bold; text-align: left"><h3>N&Oacute;MINA POR MES ULTIMO A&Ntilde;O</h3></caption>
                          <thead>
                            <tr class="odd">
                                <th width="50%" scope="col">MES</th>
                                <th width="50%" scope="col">N&Oacute;MINA</th>
                                
                            </tr>	
                           </thead>
                          
                            <tbody>
				       <?php
    
  
     //$genera=$obj->hist_quin_nomina();
     if($lista14==null){
	echo "<tr>
	  <td colspan='5'>No hay datos a Mostrar</tr>";
     }else{
     
	  $cont=count($lista14);
           for($i=0; $i<$cont; $i++){
           
          
              if($i % 2){
     
     echo "<tr class='odd'>";
     }else{
     echo "<tr>";
     }
            
      ?>
                           
                                <td><?php echo @$obj->mes($lista14[$i]["mes"]);?></td>
                                <td><?php echo "$ ".$tot=number_format(@$lista14[$i]["total"], 2, ",", ".");?></td>
                            </tr>
                            
                             <?php } }?>
                            </tbody>
                        </table>