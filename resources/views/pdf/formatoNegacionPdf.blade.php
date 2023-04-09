<html>
    <head>
        <style>
            @page {
                margin-top: 250px; 
                margin-bottom: 50px;


            }
            #header { 
                position: fixed;
                top: -200px;


            }

        </style>
    <body>
        <div id="header" >
            <table border="1" cellpadding="0" cellspacing="0" width="100%" bordercolor="#545545" style="text-align: center;font-size: 14px; color:#515A5A; 1px solid #515A5A; " >
                <tbody>
                    <tr>
                        <td colspan="1" rowspan="4" width="15%" style="border: 1px solid #515A5A;" >   
                            <img style="opacity: 0.6;width: 100px; margin-left: 3px;margin-bottom: 3px;margin-right: 3px;margin-top: 3px"  src="<?php echo $_SERVER["DOCUMENT_ROOT"] . '/imagenes/imagenesCartas/positivaColor.png'; ?>"/>
                        </td>
                        <td colspan="6" rowspan="3"  width="60%" style="border: 1px solid #515A5A;" > PROCESO: Gestión de Siniestros</td>
                        <td colspan="1" style="border: 1px solid #515A5A;" > Código:</td>
                        <td colspan="1" style="border: 1px solid #515A5A;" > MIS_5_4_2_FR33</td>
                    </tr>
                    <tr>
                        <td colspan="1" style="border: 1px solid #515A5A;" > Versión:</td>
                        <td colspan="1" style="border: 1px solid #515A5A;" > 1</td>
                    </tr>
                    <tr>
                        <td colspan="1" style="border: 1px solid #515A5A;" > Fecha:</td>
                        <td colspan="1" style="border: 1px solid #515A5A;" > 2016/07/01</td>
                    </tr>
                    <tr>
                        <td colspan="8" rowspan="1" style="border: 1px solid #515A5A;" > FORMATO <br>
                            <b>NEGACIÓN A SOLICITUD DE RECALIFICACIÓN PERDIDAD DE CAPACIDAD LABORAL</b>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" rowspan="1" style="border: 1px solid #515A5A;"  > <b>Aprobó:</b><br>
                            German Javier Fernández Ricardo<br>
                            Gerente Médico
                        </td>
                        <td colspan="3" rowspan="1" style="border: 1px solid #515A5A;" > <b>Revisó: </b><br>
                            Silvia Alejandra Cruz Lizcano<br>
                            Líder SIG
                        </td>
                        <td colspan="3" rowspan="1" style="border: 1px solid #515A5A;" > <b>Elaboró: </b><br>
                            Carolina Cuervo Gasca<br>
                            Médico Especialista Nivel Central
                        </td>
                    </tr>
                </tbody>
            </table>      
        </div>

        <div id="content" >
              <?php
        $now = new \DateTime();
        $meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
        ?>
            {!! Form::model($infoSiniestro, ['route'=>['FormatoNegacion.update',$infoSiniestro->idSiniestroPcl], 'method'=>'put'])  !!}

            <h4 style="margin-left: 45px; margin-top: -20px" ><i>INFORMACION GENERAL DE LA ENTIDAD CALIFICADORA</i></h4>
            <table border="1" cellpadding="0" cellspacing="0" width="94%" bordercolor="#545545" style="margin-left: 30px; margin-top: -22px;text-align: left;font-size: 14px; color:#000; 1px solid #000;" >
                <tbody>
                    <tr>                      
                        <td colspan="4" style="border: 2px solid #000;" >&nbsp; NOMBRE ENTIDAD ADMINISTRADORA</td>
                        <td colspan="4" style="border: 2px solid #000;" >&nbsp;  POSITIVA COMPAÑÍA DE SEGUROS</td>
                    </tr>
                    <tr>                      
                        <td colspan="2" style="border: 2px solid #000;" >&nbsp; DIRECCION</td>
                        <td colspan="2" style="border: 2px solid #000;" >&nbsp; AVDA CRA 45 No 94-83</td>
                        <td colspan="2" style="border: 2px solid #000;" >&nbsp; TELEFONO</td>
                        <td colspan="2" style="border: 2px solid #000;" >&nbsp; 6502200</td>
                    </tr>
                    <tr>                      
                        <td colspan="2" style="border: 2px solid #000;" >&nbsp; CIUDAD</td>
                        <td colspan="2" style="border: 2px solid #000;" >&nbsp; BOGOTA</td>
                        <td colspan="2" style="border: 2px solid #000;" >&nbsp; FECHA:</td>
                        <td colspan="2" style="border: 2px solid #000;" >&nbsp; <?php echo $now->format('d') . ' de ' . $meses[$now->format('n')- 1] . ' de ' . $now->format('Y') ?></td>
                    </tr>
                </tbody>
            </table>
            <h4 style="margin-left: 45px"><i>DICTAMEN MOTIVO DE ANALISIS</i></h4>
            <table border="1" cellpadding="0" cellspacing="0" width="94%" bordercolor="#545545" style="margin-left: 30px; margin-top: -22px;text-align: center;font-size: 14px; color:#000; 1px solid #000;" >
                <tbody>
                    <tr>                      
                        <td style="border: 2px solid #000;" >&nbsp;  ENTIDAD CALIFICADORA</td>
                        <td style="border: 2px solid #000;" >&nbsp;  NUMERO DE DICTAMEN</td>
                        <td style="border: 2px solid #000;" >&nbsp;  FECHA DEL DICTAMEN</td>
                        <td style="border: 2px solid #000;" >&nbsp;  DIAGNOSTICO</td>
                        <td style="border: 2px solid #000;" >&nbsp;  PERDIDA DE CAPACIDAD LABORAL</td>
                    </tr>
                    <tr>          
                        <td style="border: 2px solid #000;" >&nbsp;  {{$infoSiniestro->entidadCalificaPcl}}</td>
                        <td style="border: 2px solid #000;" >&nbsp;  {{$infoSiniestro->numeroDictamen}}</td>
                        <td style="border: 2px solid #000;" >&nbsp;  {{$infoSiniestro->fechaDictamenCalificacion}}</td>
                        <td style="border: 2px solid #000;" >&nbsp;  @foreach  ($cie as $user)
                            {{$user -> id_ident}} {{$user -> cie_10}},
                            @endforeach</td>
                        <td style="border: 2px solid #000;" > {{$infoSiniestro->porcentajePclRecalificacion}}%</td>
                    </tr>
                </tbody>
            </table>
            <h4 style="margin-left: 45px"><i>DATOS PERSONALES DEL CALIFICADO</i></h4>
            <table border="1" cellpadding="0" cellspacing="0" width="94%" bordercolor="#545545" style="margin-left: 30px; margin-top: -22px;text-align: left;font-size: 14px; color:#000; 1px solid #000;" >
                <tbody>
                    <tr>                      
                        <td colspan="2" style="border: 2px solid #000;" >&nbsp;APELLIDOS</td>
                        <td colspan="9" style="border: 2px solid #000;" >&nbsp;{{$infoSiniestro->nombre}}</td>
                    </tr>
                    <tr>          
                        <td colspan="2" Style="border: 2px solid #000;" >&nbsp;NOMBRES</td>
                        <td colspan="9" style="border: 2px solid #000;">&nbsp;{{$infoSiniestro->nombre}}</td>
                    </tr>
                    <tr>          
                        <td colspan="2"  style="border: 2px solid #000;" >&nbsp;DOC.  IDENTIDAD</td>
                        <td colspan="5"  style="border: 2px solid #000;" >&nbsp;{{$infoSiniestro->documento}}</td>
                        <td colspan="4"  style="border: 2px solid #000;" >&nbsp;</td>
                    </tr>
                    <tr>          
                        <td colspan="2"  style="border: 2px solid #000;" >&nbsp;FECHA NTO.</td>
                        <td colspan="5"  style="border: 2px solid #000;" >&nbsp;{{$TxtFecha}}</td>
                        <td colspan="2"  style="border: 2px solid #000;" >&nbsp;EDAD</td>
                        <td colspan="2"  style="border: 2px solid #000;" >&nbsp;{{$edad}}</td>
                    </tr>
                    <tr>          
                        <td  colspan="2" style="border: 2px solid #000;" >&nbsp;GENERO</td>
                        <td  colspan="9" style="border: 2px solid #000;" >&nbsp;{{$TxtGenero}}</td>
                    </tr>
                    <tr>          
                        <td style="border: 2px solid #000;">&nbsp;ESTADO CIVIL</td>
                        <td style="border: 2px solid #000;">&nbsp;SOLTERO</td>
                        <td style="border: 2px solid #000;" width="3%" >&nbsp; @if($TxtEstadoCivil == '1') X @endif</td>
                        <td style="border: 2px solid #000;">&nbsp;CASADO</td>
                        <td style="border: 2px solid #000;" width="3%" >&nbsp;@if($TxtEstadoCivil == '2') X @endif</td>
                        <td style="border: 2px solid #000;">&nbsp;VIUDO</td>
                        <td style="border: 2px solid #000;" width="3%" >&nbsp;@if($TxtEstadoCivil == '3') X @endif</td>
                        <td style="border: 2px solid #000;">&nbsp;U.L </td>
                        <td style="border: 2px solid #000;" width="3%" >&nbsp;@if($TxtEstadoCivil == '4') X @endif</td>
                        <td style="border: 2px solid #000;">&nbsp;SEPARADO</td>
                        <td style="border: 2px solid #000;" width="3%" >&nbsp;@if($TxtEstadoCivil == '5') X @endif</td>
                    </tr>
                    <tr>          
                        <td style="border: 2px solid #000;">&nbsp;ESCOLARIDAD</td>
                        <td style="border: 2px solid #000;">&nbsp;PRIMARIA</td>
                        <td style="border: 2px solid #000;" width="3%" >&nbsp;@if($TxtEstadoCivil == '1') X @endif</td>
                        <td style="border: 2px solid #000;" width="3%" >&nbsp;SECUND</td>
                        <td style="border: 2px solid #000;" width="3%" >&nbsp;@if($TxtEstadoCivil == '2') X @endif</td>
                        <td style="border: 2px solid #000;">&nbsp;TECNICO</td>
                        <td style="border: 2px solid #000;" width="3%" >&nbsp;@if($TxtEstadoCivil == '3') X @endif</td>
                        <td style="border: 2px solid #000;">&nbsp;UNIVERSITA </td>
                        <td style="border: 2px solid #000;" width="3%" >&nbsp;@if($TxtEstadoCivil == '4') X @endif</td>
                        <td style="border: 2px solid #000;">&nbsp;OTRO</td>
                        <td style="border: 2px solid #000;" width="3%" >&nbsp;@if($TxtEstadoCivil == '5') X @endif</td>
                    </tr>
                </tbody>
            </table>

            <h4 style="margin-left: 45px"><i>ANTECEDENTES LABORALES</i></h4>
            <table border="1" cellpadding="0" cellspacing="0" width="94%" bordercolor="#545545" style="margin-left: 30px; margin-top: -22px;text-align: left;font-size: 14px; color:#000; 1px solid #000;" >
                <tbody>
                    <tr>                      
                        <td style="border: 2px solid #000;" >&nbsp;NOMBRE EMPRESA </td>
                        <td style="border: 2px solid #000;" >&nbsp;{{$infoSiniestro->razon_social_empleador}}</td>
                    </tr>
                    <tr>    
                        <td Style="border: 2px solid #000;" >&nbsp;CARGO ACTUAL</td>
                        <td style="border: 2px solid #000;">&nbsp;{{$TxtCargo}}</td>
                    </tr>
                    <tr>  
                        <td Style="border: 2px solid #000;" >&nbsp;ANTIGÜEDAD EN LA <br>&nbsp;EMPRESA</td>
                        <td style="border: 2px solid #000;">&nbsp;{{$TxtAntiguedadEmpresa}}</td>
                    </tr>                       
                </tbody>
            </table>
            <h4 style="margin-left: 45px"><i>FUNDAMENTOS DE LA SOLICITUD</i></h4>
            <h4 style="margin-left: 45px"><i>RELACION DOCUMENTOS</i></h4>
            <table border="1" cellpadding="0" cellspacing="0" width="94%" bordercolor="#545545" style="margin-left: 30px; margin-top: -22px;text-align: left;font-size: 14px; color:#000; 1px solid #000;" >
                <tbody>
                    <tr>                      
                        <td style="border: 2px solid #000;" >&nbsp;DOCUMENTO </td>
                        <td Style="border: 2px solid #000;" >&nbsp;DESCRIPCION</td>
                    </tr>
                    <tr>    
                        <td Style="border: 2px solid #000;" >&nbsp;HISTORIA CLINICA</td>
                        <td style="border: 2px solid #000;">&nbsp;{{$TxtHistoriaClinica}}</td>
                    </tr>
                    <tr>  
                        <td Style="border: 2px solid #000;" >&nbsp;ESTUDIOS</td>
                        <td style="border: 2px solid #000;">{{$TxtEstudios}}</td>
                    </tr>                       
                </tbody>
            </table>

            <h4 style="margin-left: 40px; "><i>RESUMEN CLINICO Y JUSTIFICACION DE LA NO PERTINENCIA DERECALIFICACION</i></h4>
            <table border="1" cellpadding="0" cellspacing="0" width="94%" bordercolor="#545545" style="margin-left: 30px; margin-top: -22px;text-align: left;font-size: 14px; color:#000; 1px solid #000;" >
                <tbody>
                    <tr>                      
                        <td style="border: 2px solid #000;" >&nbsp;{{$TxtResumen}}</td>
                    </tr>                                      
                </tbody>
            </table>
            <h4 style="margin-left: 40px; "><i>DIAGNOSTICO</i></h4>
            <table border="1" cellpadding="0" cellspacing="0" width="94%" bordercolor="#545545" style="margin-left: 30px; margin-top: -22px;text-align: left;font-size: 14px; color:#000; 1px solid #000;" >
                <tbody>
                    <tr>                      
                        <td Style="border: 2px solid #000;" >&nbsp;@foreach  ($cie as $user)
                            {{$user -> id_ident}},
                            @endforeach
                        </td>
                        <td style="border: 2px solid #000;">&nbsp;@foreach  ($cie as $user)
                            {{$user -> id_ident}} {{$user -> cie_10}},
                            @endforeach
                        </td>
                    </tr>                                      
                </tbody>
            </table>

            <h4 style="margin-left: 40px; "><i>EXAMENES E INTERCONSULTAS PERTINENTES</i></h4>
            <table border="1" cellpadding="0" cellspacing="0" width="94%" bordercolor="#545545" style="margin-left: 30px; margin-top: -22px;text-align: left;font-size: 14px; color:#000; 1px solid #000;" >
                <tbody>
                    <tr>                      
                        <td Style="border: 2px solid #000;" width="4%"  >&nbsp;ID</td>
                        <td Style="border: 2px solid #000;" width="10%" >&nbsp;TIPO EXAMEN INTERCONSULTA </td>
                        <td Style="border: 2px solid #000;" >&nbsp;ULTIMO RESULTADO</td>
                    </tr>      
                    <tr>                      
                        <td Style="border: 2px solid #000;" >&nbsp;{{$TxtId}}</td>
                        <td Style="border: 2px solid #000;" >&nbsp;{{$TxtTipoExamen}} </td>
                        <td Style="border: 2px solid #000;" >&nbsp;{{$TxtultimoResultado}}</td>
                    </tr>   
                </tbody>
            </table>
            <h4 style="margin-left: 40px; "><i>CONCLUSION</i></h4>
            <table border="1" cellpadding="0" cellspacing="0" width="94%" bordercolor="#545545" style="margin-left: 30px; margin-top: -22px;text-align: left;font-size: 14px; color:#000; 1px solid #000;" >
                <tbody>
                    <tr>                      
                        <td Style="border: 2px solid #000;" >&nbsp;{{$TxtConclusion}}</td>
                    </tr>                                      
                </tbody>
            </table>
            <h4 style="margin-left: 40px; "><i>RESPONSABLES DE LA RECALIFICACION</i></h4>
            <table border="1" cellpadding="0" cellspacing="0" width="94%" bordercolor="#545545" style="margin-left: 30px; margin-top: -22px;text-align: left;font-size: 14px; color:#000; 1px solid #000;" >
                <tbody>
                    <tr>                      
                        <td Style="border: 2px solid #000;" width="10%" >&nbsp;MEDICO LABORAL</td>
                        <td Style="border: 2px solid #000;" >&nbsp;{{$TxtMedico}}</td>          
                    </tr>  
                    <tr>                      
                        <td Style="border: 2px solid #000;" width="10%" >&nbsp;RM 3227  LSO 789</td>
                        <td Style="border: 2px solid #000;" >&nbsp;{{$TxtRm}}</td>          
                    </tr>  
                </tbody>
            </table>
            {!! Form::close() !!}

        </div>
    </body>


</html>