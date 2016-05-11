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
           for($i=0; $i<=$cont; $i++){
   
      ?>                     
                            <?php if($lista14[$i]["periodo"]== '1' || $lista14[$i]["periodo"]== '2' ){?>
                            <tr>
                                <td><?php echo "Enero";?></td>
                                <td><?php echo "$ ".$tot=number_format(@$lista14[$i]["total"]+@$lista14[$i+1]["total"], 2, ",", ".");?></td>
			    </tr><?php }?>
			    
			     <?php if($lista14[$i]["periodo"]== '3' || $lista14[$i]["periodo"]== '4' ){?>
                            <tr>
                                <td><?php echo "Febrero";?></td>
                                <td><?php echo "$ ".$tot=number_format(@$lista14[$i]["total"]+@$lista14[$i+1]["total"], 2, ",", ".");?></td>
			    </tr><?php }?>
			    
			    
                             <?php if($lista14[$i]["periodo"]== '5' || $lista14[$i]["periodo"]== '6' ){?>
                            <tr>
                                <td><?php echo "Marzo";?></td>
                                <td><?php echo "$ ".$tot=number_format(@$lista14[$i]["total"]+@$lista14[$i+1]["total"], 2, ",", ".");?></td>
			    </tr><?php }?>
			    
			     <?php if($lista14[$i]["periodo"]== '7' || $lista14[$i]["periodo"]== '8' ){?>
                            <tr>
                                <td><?php echo "Abril";?></td>
                                <td><?php echo "$ ".$tot=number_format(@$lista14[$i]["total"]+@$lista14[$i+1]["total"], 2, ",", ".");?></td>
			    </tr><?php }?>
			    
			     <?php if($lista14[$i]["periodo"]== '9' || $lista14[$i]["periodo"]== '10' ){?>
                            <tr>
                                <td><?php echo "Mayo";?></td>
                                <td><?php echo "$ ".$tot=number_format(@$lista14[$i]["total"]+@$lista14[$i+1]["total"], 2, ",", ".");?></td>
			    </tr><?php }?>
			    
			     <?php if($lista14[$i]["periodo"]== '11' || $lista14[$i]["periodo"]== '12' ){?>
                            <tr>
                                <td><?php echo "Junio";?></td>
                                <td><?php echo "$ ".$tot=number_format(@$lista14[$i]["total"]+@$lista14[$i+1]["total"], 2, ",", ".");?></td>
			    </tr><?php }?>
			    
			     <?php if($lista14[$i]["periodo"]== '13' || $lista14[$i]["periodo"]== '14' ){?>
                            <tr>
                                <td><?php echo "Julio";?></td>
                                <td><?php echo "$ ".$tot=number_format(@$lista14[$i]["total"]+@$lista14[$i+1]["total"], 2, ",", ".");?></td>
			    </tr><?php }?>
			    
			     <?php if($lista14[$i]["periodo"]== '15' || $lista14[$i]["periodo"]== '16' ){?>
                            <tr>
                                <td><?php echo "Agosto";?></td>
                                <td><?php echo "$ ".$tot=number_format(@$lista14[$i]["total"]+@$lista14[$i+1]["total"], 2, ",", ".");?></td>
			    </tr><?php }?>
			    
			     <?php if($lista14[$i]["periodo"]== '17' || $lista14[$i]["periodo"]== '18' ){?>
                            <tr>
                                <td><?php echo "Septiembre";?></td>
                                <td><?php echo "$ ".$tot=number_format(@$lista14[$i]["total"]+@$lista14[$i+1]["total"], 2, ",", ".");?></td>
			    </tr><?php }?>
			    
			     <?php if($lista14[$i]["periodo"]== '19' || $lista14[$i]["periodo"]== '20' ){?>
                            <tr>
                                <td><?php echo "Octubre";?></td>
                                <td><?php echo "$ ".$tot=number_format(@$lista14[$i]["total"]+@$lista14[$i+1]["total"], 2, ",", ".");?></td>
			    </tr><?php }?>
			    
			     <?php if($lista14[$i]["periodo"]== '21' || $lista14[$i]["periodo"]== '22' ){?>
                            <tr>
                                <td><?php echo "Nomviembre";?></td>
                                <td><?php echo "$ ".$tot=number_format(@$lista14[$i]["total"]+@$lista14[$i+1]["total"], 2, ",", ".");?></td>
			    </tr><?php }?>
			    
			     <?php if($lista14[$i]["periodo"]== '23' || $lista14[$i]["periodo"]== '24' ){?>
                            <tr>
                                <td><?php echo "Diciembre";?></td>
                                <td><?php echo "$ ".$tot=number_format(@$lista14[$i]["total"]+@$lista14[$i+1]["total"], 2, ",", ".");?></td>
			    </tr><?php }?>
                            
                             <?php }}?>
                            </tbody>
                        </table>