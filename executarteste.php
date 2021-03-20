<?php 
include('conecta.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <!--
    Modified from the Debian original for Ubuntu
    Last updated: 2016-11-16
    See: https://launchpad.net/bugs/1288690
  -->
  <head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <style type="text/css">

.Titulo {
	text-align: center;
	font-family: Verdana, Geneva, Tahoma, sans-serif;
	color: #FFFFFF;
	text-align: center;
	font-size: 48px;
	}



.SubTitulo {
	text-align: center;
	font-family: Cambria, Geneva, Tahoma, sans-serif;
	color: #FFFFFF;
	text-align: center;
	font-size: 20px;
	line-height: 150%;

}



.Conteudo {
	text-align: center;
	font-family: "Tahoma";
	color: #FFFFFF;
	text-align: center;
	font-size: 15px;
	line-height: 150%;
}
.texto {
	text-align: center;
	font-family: Georgia;
	color: #000000;
	text-align: center;
	font-size: 15px;
	line-height: 150%;
}
.subTexto{
	text-align: center;
	font-family: Georgia;
	color: #000000;
	text-align: center;
	font-size: 8px;
	
}
 
 
 

	.auto-style3 {
		text-align: center;
		font-family: "Candara Light";
		color: #FFFFFF;
		text-align: center;
		font-size: 48px;
	}
 

	.auto-style4 {
	text-align: center;
	font-family: "Tahoma";
	color: #FFFFFF;
	text-align: left;
	font-size: 15px;
	line-height: 150%;
}
 

	</style>

  <SCRIPT type="text/javascript" src="vkboards.js"></SCRIPT>
  <SCRIPT type="text/javascript"><!--

   // Parts of the following code are taken from the DocumentSelection
   // library (http://debugger.ru/projects/browserextensions/documentselection)
   // by Ilya Lebedev. DocumentSelection is distributed under LGPL license
   // (http://www.gnu.org/licenses/lgpl.html).

   // 'insertionS' and 'insertionE' contain the start and end
   // positions of current selection.
   //
   var opened = false, vkb = null, text = null, insertionS = 0, insertionE = 0;

   var userstr = navigator.userAgent.toLowerCase();
   var safari = (userstr.indexOf('applewebkit') != -1);
   var gecko  = (userstr.indexOf('gecko') != -1) && !safari;
   var standr = gecko || window.opera || safari;

   function keyb_change()
   {
     document.getElementById("switch").innerHTML = (opened ? "Show keyboard" : "Hide keyboard");
     opened = !opened;

     if(opened && !vkb)
     {
       // Note: all parameters, starting with 3rd, in the following
       // expression are optional; their values are equal to the
       // default parameter values for the VKeyboard object.
       // The only exception is 18th parameter (flash switch),
       // which is false by default.

       vkb = new VKeyboard("keyboard",    // container's id
                           keyb_callback, // reference to the callback function
                           true,          // create the arrow keys or not? (this and the following params are optional)
                           true,          // create up and down arrow keys? 
                           false,         // reserved
                           true,          // create the numpad or not?
                           "",            // font name ("" == system default)
                           "14px",        // font size in px
                           "#000",        // font color
                           "#F00",        // font color for the dead keys
                           "#FFF",        // keyboard base background color
                           "#FFF",        // keys' background color
                           "#DDD",        // background color of switched/selected item
                           "#777",        // border color
                           "#FFF",        // border/font color of "inactive" key (key with no value/disabled)
                           "#FFF",        // background color of "inactive" key (key with no value/disabled)
                           "#F77",        // border color of the language selector's cell
                           true,          // show key flash on click? (false by default)
                           "#CC3300",     // font color during flash
                           "#FF9966",     // key background color during flash
                           "#CC3300",     // key border color during flash
                           false,         // embed VKeyboard into the page?
                           true,          // use 1-pixel gap between the keys?
                           0);            // index(0-based) of the initial layout
     }
     else
       vkb.Show(opened);

     text = document.getElementById("textfield");
     text.focus();

     if(document.attachEvent)
       text.attachEvent("onblur", backFocus);
   }

   function backFocus()
   {
     if(opened)
     {
       setRange(text, insertionS, insertionE);

       text.focus();
     }
   }

   // Advanced callback function:
   //
   function keyb_callback(ch)
   {
     var val = text.value;

     switch(ch)
     {
       case "BackSpace":
         if(val.length)
         {
           var span = null;

           if(document.selection)
             span = document.selection.createRange().duplicate();

           if(span && span.text.length > 0)
           {
             span.text = "";
             getCaretPositions(text);
           }
           else
             deleteAtCaret(text);
         }

         break;

       case "<":
         if(insertionS > 0)
           setRange(text, insertionS - 1, insertionE - 1);

         break;

       case ">":
         if(insertionE < val.length)
           setRange(text, insertionS + 1, insertionE + 1);

         break;

       case "/\\":
         if(!standr) break;

         var prev  = val.lastIndexOf("\n", insertionS) + 1;
         var pprev = val.lastIndexOf("\n", prev - 2);
         var next  = val.indexOf("\n", insertionS);

         if(next == -1) next = val.length;
         var nnext = next - insertionS;

         if(prev > next)
         {
           prev  = val.lastIndexOf("\n", insertionS - 1) + 1;
           pprev = val.lastIndexOf("\n", prev - 2);
         }

         // number of chars in current line to the left of the caret:
         var left = insertionS - prev;

         // length of the prev. line:
         var plen = prev - pprev - 1;

         // number of chars in the prev. line to the right of the caret:
         var right = (plen <= left) ? 1 : (plen - left);

         var change = left + right;
         setRange(text, insertionS - change, insertionE - change);

         break;

       case "\\/":
         if(!standr) break;

         var prev  = val.lastIndexOf("\n", insertionS) + 1;
         var next  = val.indexOf("\n", insertionS);
         var pnext = val.indexOf("\n", next + 1);

         if( next == -1)  next = val.length;
         if(pnext == -1) pnext = val.length;

         if(pnext < next) pnext = next;

         if(prev > next)
            prev  = val.lastIndexOf("\n", insertionS - 1) + 1;

         // number of chars in current line to the left of the caret:
         var left = insertionS - prev;

         // length of the next line:
         var nlen = pnext - next;

         // number of chars in the next line to the left of the caret:
         var right = (nlen <= left) ? 0 : (nlen - left - 1);

         var change = (next - insertionS) + nlen - right;
         setRange(text, insertionS + change, insertionE + change);

         break;

       default:
         insertAtCaret(text, (ch == "Enter" ? (window.opera ? '\r\n' : '\n') : ch));
     }
   }

   // This function retrieves the position (in chars, relative to
   // the start of the text) of the edit cursor (caret), or, if
   // text is selected in the TEXTAREA, the start and end positions
   // of the selection.
   //
   function getCaretPositions(ctrl)
   {
     var CaretPosS = -1, CaretPosE = 0;

     // Mozilla way:
     if(ctrl.selectionStart || (ctrl.selectionStart == '0'))
     {
       CaretPosS = ctrl.selectionStart;
       CaretPosE = ctrl.selectionEnd;

       insertionS = CaretPosS == -1 ? CaretPosE : CaretPosS;
       insertionE = CaretPosE;
     }
     // IE way:
     else if(document.selection && ctrl.createTextRange)
     {
       var start = end = 0;
       try
       {
         start = Math.abs(document.selection.createRange().moveStart("character", -10000000)); // start

         if (start > 0)
         {
           try
           {
             var endReal = Math.abs(ctrl.createTextRange().moveEnd("character", -10000000));

             var r = document.body.createTextRange();
             r.moveToElementText(ctrl);
             var sTest = Math.abs(r.moveStart("character", -10000000));
             var eTest = Math.abs(r.moveEnd("character", -10000000));

             if ((ctrl.tagName.toLowerCase() != 'input') && (eTest - endReal == sTest))
               start -= sTest;
           }
           catch(err) {}
         }
       }
       catch (e) {}

       try
       {
         end = Math.abs(document.selection.createRange().moveEnd("character", -10000000)); // end
         if(end > 0)
         {
           try
           {
             var endReal = Math.abs(ctrl.createTextRange().moveEnd("character", -10000000));

             var r = document.body.createTextRange();
             r.moveToElementText(ctrl);
             var sTest = Math.abs(r.moveStart("character", -10000000));
             var eTest = Math.abs(r.moveEnd("character", -10000000));

             if ((ctrl.tagName.toLowerCase() != 'input') && (eTest - endReal == sTest))
              end -= sTest;
           }
           catch(err) {}
         }
       }
       catch (e) {}

       insertionS = start;
       insertionE = end
     }
   }

   function setRange(ctrl, start, end)
   {
     if(ctrl.setSelectionRange) // Standard way (Mozilla, Opera, Safari ...)
     {
       ctrl.setSelectionRange(start, end);
     }
     else // MS IE
     {
       var range;

       try
       {
         range = ctrl.createTextRange();
       }
       catch(e)
       {
         try
         {
           range = document.body.createTextRange();
           range.moveToElementText(ctrl);
         }
         catch(e)
         {
           range = null;
         }
       }

       if(!range) return;

       range.collapse(true);
       range.moveStart("character", start);
       range.moveEnd("character", end - start);
       range.select();
     }

     insertionS = start;
     insertionE = end;
   }

   function deleteSelection(ctrl)
   {
     if(insertionS == insertionE) return;

     var tmp = (document.selection && !window.opera) ? ctrl.value.replace(/\r/g,"") : ctrl.value;
     ctrl.value = tmp.substring(0, insertionS) + tmp.substring(insertionE, tmp.length);

     setRange(ctrl, insertionS, insertionS);
   }

   function deleteAtCaret(ctrl)
   {
     // if(insertionE < insertionS) insertionE = insertionS;
     if(insertionS != insertionE)
     {
       deleteSelection(ctrl);
       return;
     }

     if(insertionS == insertionE)
       insertionS = insertionS - 1;

     var tmp = (document.selection && !window.opera) ? ctrl.value.replace(/\r/g,"") : ctrl.value;
     ctrl.value = tmp.substring(0, insertionS) + tmp.substring(insertionE, tmp.length);

     setRange(ctrl, insertionS, insertionS);
   }

   // This function inserts text at the caret position:
   //
   function insertAtCaret(ctrl, val)
   {
     if(insertionS != insertionE) deleteSelection(ctrl);

     if(gecko && document.createEvent && !window.opera)
     {
       var e = document.createEvent("KeyboardEvent");

       if(e.initKeyEvent && ctrl.dispatchEvent)
       {
         e.initKeyEvent("keypress",        // in DOMString typeArg,
                        false,             // in boolean canBubbleArg,
                        true,              // in boolean cancelableArg,
                        null,              // in nsIDOMAbstractView viewArg, specifies UIEvent.view. This value may be null;
                        false,             // in boolean ctrlKeyArg,
                        false,             // in boolean altKeyArg,
                        false,             // in boolean shiftKeyArg,
                        false,             // in boolean metaKeyArg,
                        null,              // key code;
                        val.charCodeAt(0));// char code.

         ctrl.dispatchEvent(e);
       }
     }
     else
     {
       var tmp = (document.selection && !window.opera) ? ctrl.value.replace(/\r/g,"") : ctrl.value;
       ctrl.value = tmp.substring(0, insertionS) + val + tmp.substring(insertionS, tmp.length);
     }

     setRange(ctrl, insertionS + val.length, insertionS + val.length);
   }

 //--></SCRIPT>

    </head>
  <?php
//inclui cabeçalho padrao da pagina com menu
 ///include('topo.php'); 
?>

  <body style="background-color: #222E34;" onload="new VKeyboard("keyboard", keyb_callback);">
	<p><?php
	
	$id=$_GET['id'];
	$query = "SELECT idMaquina,Maquina,idAtividade,txAtividade,Periodicidade,HorimetroAlerta,HorimetroUltima,HorimetroProxima,Horimetro FROM tbAtividades INNER JOIN tbMaquinas USING (idMaquina) WHERE idAtividade=".$id.";";


			if ($stmt = $con->prepare($query)) {
			    $stmt->execute();
			    $stmt->bind_result($idMaquina, $Maquina, $idAtividade, $txAtividade, $Periodicidade, $HorimetroAlerta, $HorimetroUltima, $HorimetroProxima, $Horimetro );
			    while ($stmt->fetch()) {
			        //printf("%s, %s\n", $field1, $field2);
			    }
			    $stmt->close();
			    $Gap=$HorimetroProxima-$Horimetro;
			 }   
			    
			if(isset($_POST["btEnv"])){  
						if(empty($_POST["nuIDExec"]))
							$erro = "Digite seu ID";
						else
						if(empty($_POST["txNome"]))
							$erro = "Qual seu Nome?";
						else
						{
						
						//Vamos realizar o cadastro ou alteração dos dados enviados.
					
							  	$nuIDExec=$_POST["nuIDExec"];
								$txObs=$_POST["txObs"];
								$txNome=$_POST["txNome"];
								$ProximaNew=$Periodicidade+$Horimetro;
								$query = "INSERT INTO `Horimetros`.`tbExecucoes` (`time`,`idMaquina`, `idAtividade`, `IDFuncionario`, `NomeFunc`, `HorimetroExec`, `GapHorimetro`, `Observacao`) VALUES (CONVERT_TZ(now(),'+00:00','-3:00'),".$idMaquina.",".$idAtividade.",".$nuIDExec.",'".$txNome."',".$Horimetro.",".$Gap.",'".$txObs."');";
								$query.= "UPDATE `Horimetros`.`tbAtividades` SET `time` = CONVERT_TZ(now(),'+00:00','-3:00'), `HorimetroUltima` =".$Horimetro.", `HorimetroProxima` = ".$ProximaNew." WHERE `idAtividade` = ".$id.";";
								//"INSERT INTO `Horimetros`.`tbExecucoes`(`time`,`idMaquina`,`idAtividade`,`IDFuncionario`,`NomeFunc`,`HorimetroExec`,`GapHorimetro`,Observacao) VALUES(now(),".$idMaquina.",'".$idAtividade."',".$nuIDExec.",".$txNome.",".$Horimetro.",".$Gap.",'".$txObs."')";
								$query2;
									if ($con->multi_query($query)) {
									    $sucesso="Dados Cadastrados";
									    echo "<script>window.close();</script>";
									    }else{
									    $erro=$mysqli->error;
								
									}
						}
			}
	
	?><form method="post" action="<?php $_SERVER["PHP_SELF"]?>">
	<table style="width: 563px; height: 233px;" align="center" class="auto-style3"><font color="#212182">
		<tr>
			<td class="Conteudo" colspan="2"><strong>Finalizar Atividade</strong></td>
		</tr>
		<tr>
			<td class="auto-style4" style="height: 23px; width: 216px;"><strong>Maquina: </strong><?php echo $Maquina ?></td>
			<td class="auto-style4" style="height: 23px"><strong>Atividade: </strong><?php echo $txAtividade ?></td>
		</tr>
		<tr>
			<td class="auto-style4" style="width: 216px"><strong>Horimetro Atual: </strong><?php echo $Horimetro ?></td>
			<td class="auto-style4"><strong>Horimetro Programado: </strong><?php echo $HorimetroProxima?></td>
		</tr>
		<tr>
			<td class="auto-style4" style="width: 216px"><strong>Gap Horas: </strong><?php echo $Gap ?></td>
			<td class="auto-style4">&nbsp;</td>
		</tr>
		<tr>
			<td class="auto-style4" colspan="2">
			<strong>Observações:</strong>&nbsp; 
			<input name="txObs" type="text" style="background: #43494B; border-color:#CECECE; border-radius: 5px 5px 5px 5px; height: 25px; width: 356px;"Conteudo"></td>
		</tr>
		<tr>
			<td class="auto-style4" style="height: 79px;" colspan="2">
			
			ID Executante:&nbsp;&nbsp;</span><input name="nuIDExec" type="text" style="background: #43494B; border-color:#CECECE; border-radius: 5px 5px 5px 5px; height: 25px; width: 100px;"Conteudo"> Nome Executante:&nbsp;&nbsp; 
			</span><input name="txNome" type="text" onkeyup="getCaretPositions(this);" onclick="getCaretPositions(this);" style="background: #43494B; border-color:#CECECE; border-radius: 5px 5px 5px 5px; height: 25px;></td>
		</tr>
		<tr>
			
			<td class="Conteudo">&nbsp; 
			</td>
		</tr></font>
		<tr>
			<td class="auto-style10" colspan="2" style="height: 10px">
				<?php
				// Validação dos Dados do formulario
				//echo $query;
				if(isset($erro))
					echo '<div style="color:#F00">'.$erro.'</div><br/><br/>';
				else
				if(isset($sucesso))
					echo '<div style="color:#00f">'.$sucesso.'</div><br/><br/>';
				 
				?>
		
      <input name="btEnv" id="btEnv" type="submit" value="Salvar" style="background: #FFC72B; border-color:#43494B; border-radius: 5px 5px 5px 5px; height: 28px; width: 105px;"/>
			&nbsp;&nbsp;</td>
		</tr>
	</table>
	  </p>
	
	</form>
	<A href="javascript:keyb_change()" onclick="javascript:blur()" id="switch" style="font-family:Tahoma;font-size:14px;text-decoration:none;border-bottom: 1px dashed #0000F0;color:#0000F0">Show keyboard</A></P>

  <DIV id="keyboard"></DIV>

  <DIV id="k"></DIV>

	</body>
</html>


