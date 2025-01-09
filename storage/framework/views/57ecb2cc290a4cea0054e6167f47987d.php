
      
          <div class="card-header sticky-element bg-label-secondary d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row p-2">
            <h5 class="card-title mb-sm-0 me-2">App Setting's</h5>
          </div>
           <?php if(Session::has('success')): ?>
   <div class="alert alert-success" role="alert"><?php echo e(Session::get('success')); ?></div>
    <?php endif; ?>
          <form action="<?php echo e(url('admin/AppSettings/store')); ?>" method="post" enctype="multipart/form-data"> 
            <?php echo csrf_field(); ?>
            <div class="card-body">
              <div class="row mb-4"> 
                <div class="col-md-6">
                </div>
                <div class="col-md-6"></div>
              </div>
              <div class="row"> 
                <!-- <div class="col-md-3 mb-4">
                      <label for="name" class="form-label">Date Format <span class="text-danger">*</span></label>
                      <select name="date_format" class="form-control select2" tabindex="null">
                            <option <?php if($pSe && $pSe->date_format ==  "d-m-Y" ): ?>selected <?php endif; ?> value="d-m-Y" selected="">d-m-Y (<?php echo e(date('d-m-Y')); ?>)</option>
                            <option <?php if($pSe && $pSe->date_format ==  "m-d-Y" ): ?>selected <?php endif; ?> value="m-d-Y">m-d-Y (<?php echo e(date('m-d-Y')); ?>)</option>
                            <option <?php if($pSe && $pSe->date_format ==  "Y-m-d" ): ?>selected <?php endif; ?> value="Y-m-d">Y-m-d (<?php echo e(date('Y-m-d')); ?>)</option>
                            <option <?php if($pSe && $pSe->date_format ==  "d.m.Y" ): ?>selected <?php endif; ?> value="d.m.Y">d.m.Y (<?php echo e(date('d.m.Y')); ?>)</option>
                            <option <?php if($pSe && $pSe->date_format ==  "m.d.Y" ): ?>selected <?php endif; ?> value="m.d.Y">m.d.Y (<?php echo e(date('m.d.Y')); ?>)</option>
                            <option <?php if($pSe && $pSe->date_format ==  "Y.m.d" ): ?>selected <?php endif; ?> value="Y.m.d">Y.m.d (<?php echo e(date('Y.m.d')); ?>)</option>
                            <option <?php if($pSe && $pSe->date_format ==  "d/m/Y" ): ?>selected <?php endif; ?> value="d/m/Y">d/m/Y (<?php echo e(date('d/m/Y')); ?>)</option>
                            <option <?php if($pSe && $pSe->date_format ==  "m/d/Y" ): ?>selected <?php endif; ?> value="m/d/Y">m/d/Y (<?php echo e(date('m/d/Y')); ?>)</option>
                            <option <?php if($pSe && $pSe->date_format ==  "Y/m/d" ): ?>selected <?php endif; ?> value="Y/m/d">Y/m/d (<?php echo e(date('Y/m/d')); ?>)</option>
                            <option <?php if($pSe && $pSe->date_format ==  "d/M/Y" ): ?>selected <?php endif; ?> value="d/M/Y">d/M/Y (<?php echo e(date('d/M/Y')); ?>)</option>
                            <option <?php if($pSe && $pSe->date_format ==  "d.M.Y" ): ?>selected <?php endif; ?> value="d.M.Y">d.M.Y (<?php echo e(date('d.M.Y')); ?>)</option>
                            <option <?php if($pSe && $pSe->date_format ==  "d-M-Y" ): ?>selected <?php endif; ?> value="d-M-Y">d-M-Y (<?php echo e(date('d-M-Y')); ?>)</option>
                            <option <?php if($pSe && $pSe->date_format ==  "d M Y" ): ?>selected <?php endif; ?> value="d M Y">d M Y (<?php echo e(date('d M Y')); ?>)</option>
                            <option <?php if($pSe && $pSe->date_format ==  "d F, Y" ): ?>selected <?php endif; ?> value="d F, Y">d F, Y (<?php echo e(date('d F, Y')); ?>)</option>
                            <option <?php if($pSe && $pSe->date_format ==  "D/M/Y" ): ?>selected <?php endif; ?> value="D/M/Y">D/M/Y (<?php echo e(date('D/M/Y')); ?>)</option>
                            <option <?php if($pSe && $pSe->date_format ==  "D.M.Y" ): ?>selected <?php endif; ?> value="D.M.Y">D.M.Y (<?php echo e(date('D.M.Y')); ?>)</option>
                            <option <?php if($pSe && $pSe->date_format ==  "D-M-Y" ): ?>selected <?php endif; ?> value="D-M-Y">D-M-Y (<?php echo e(date('D-M-Y')); ?>)</option>
                            <option <?php if($pSe && $pSe->date_format ==  "D M Y" ): ?>selected <?php endif; ?> value="D M Y">D M Y (<?php echo e(date('D M Y')); ?>)</option>
                            <option <?php if($pSe && $pSe->date_format ==  "d D M Y"): ?> selected <?php endif; ?> value="d D M Y">d D M Y (<?php echo e(date('d D M Y')); ?>)</option>
                            <option <?php if($pSe && $pSe->date_format ==  "D d M Y"): ?>selected <?php endif; ?> value="D d M Y">D d M Y (<?php echo e(date('D d M Y')); ?>)</option>
                            <option <?php if($pSe && $pSe->date_format ==  "dS M Y"): ?>selected <?php endif; ?> value="dS M Y">dS M Y (<?php echo e(date('dS M Y')); ?>)</option>
                        </select>

                </div>
                <div class="col-md-3 mb-4">
                    <label for="name" class="form-label">Time Format <span class="text-danger">*</span></label>
                    <select name="time_format" class="form-control select2" tabindex="null">
                        <option <?php if($pSe && $pSe->time_format ==  "h:i a" ): ?> selected <?php endif; ?> value="h:i a" >12 Hour(s) (<?php echo e(date('h:i a')); ?>)</option>
                        <option <?php if($pSe && $pSe->time_format ==  "H:i" ): ?> selected <?php endif; ?> value="H:i" >24 Hour(s) (<?php echo e(date('H:i')); ?>)</option>
                    </select>
                </div>
                <div class="col-md-3 mb-4">
                    <label for="name" class="form-label">Default Timezone <span class="text-danger">*</span></label>
                    <select name="timezone" id="timezone" data-live-search="true" class="form-control select2" tabindex="null">
                                    <option <?php if($pSe && $pSe->timezone ==  "Africa/Abidjan" ): ?> selected <?php endif; ?> value="Africa/Abidjan">Africa/Abidjan</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Africa/Accra" ): ?> selected <?php endif; ?> value="Africa/Accra">Africa/Accra</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Africa/Addis_Ababa" ): ?> selected <?php endif; ?> value="Africa/Addis_Ababa">Africa/Addis_Ababa</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Africa/Algiers" ): ?> selected <?php endif; ?> value="Africa/Algiers">Africa/Algiers</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Africa/Asmara" ): ?> selected <?php endif; ?> value="Africa/Asmara">Africa/Asmara</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Africa/Bamako" ): ?> selected <?php endif; ?> value="Africa/Bamako">Africa/Bamako</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Africa/Bangui" ): ?> selected <?php endif; ?> value="Africa/Bangui">Africa/Bangui</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Africa/Banjul" ): ?> selected <?php endif; ?> value="Africa/Banjul">Africa/Banjul</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Africa/Bissau" ): ?> selected <?php endif; ?> value="Africa/Bissau">Africa/Bissau</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Africa/Blantyre" ): ?> selected <?php endif; ?> value="Africa/Blantyre">Africa/Blantyre</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Africa/Brazzaville" ): ?> selected <?php endif; ?> value="Africa/Brazzaville">Africa/Brazzaville</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Africa/Bujumbura" ): ?> selected <?php endif; ?> value="Africa/Bujumbura">Africa/Bujumbura</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Africa/Cairo" ): ?> selected <?php endif; ?> value="Africa/Cairo">Africa/Cairo</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Africa/Casablanca" ): ?> selected <?php endif; ?> value="Africa/Casablanca">Africa/Casablanca</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Africa/Ceuta" ): ?> selected <?php endif; ?> value="Africa/Ceuta">Africa/Ceuta</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Africa/Conakry" ): ?> selected <?php endif; ?> value="Africa/Conakry">Africa/Conakry</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Africa/Dakar" ): ?> selected <?php endif; ?> value="Africa/Dakar">Africa/Dakar</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Africa/Dar_es_Salaam" ): ?> selected <?php endif; ?> value="Africa/Dar_es_Salaam">Africa/Dar_es_Salaam</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Africa/Djibouti" ): ?> selected <?php endif; ?> value="Africa/Djibouti">Africa/Djibouti</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Africa/Douala" ): ?> selected <?php endif; ?> value="Africa/Douala">Africa/Douala</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Africa/El_Aaiun" ): ?> selected <?php endif; ?> value="Africa/El_Aaiun">Africa/El_Aaiun</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Africa/Freetown" ): ?> selected <?php endif; ?> value="Africa/Freetown">Africa/Freetown</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Africa/Gaborone" ): ?> selected <?php endif; ?> value="Africa/Gaborone">Africa/Gaborone</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Africa/Harare" ): ?> selected <?php endif; ?> value="Africa/Harare">Africa/Harare</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Africa/Johannesburg" ): ?> selected <?php endif; ?> value="Africa/Johannesburg">Africa/Johannesburg</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Africa/Juba" ): ?> selected <?php endif; ?> value="Africa/Juba">Africa/Juba</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Africa/Kampala" ): ?> selected <?php endif; ?> value="Africa/Kampala">Africa/Kampala</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Africa/Khartoum" ): ?> selected <?php endif; ?> value="Africa/Khartoum">Africa/Khartoum</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Africa/Kigali" ): ?> selected <?php endif; ?> value="Africa/Kigali">Africa/Kigali</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Africa/Kinshasa" ): ?> selected <?php endif; ?> value="Africa/Kinshasa">Africa/Kinshasa</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Africa/Lagos" ): ?> selected <?php endif; ?> value="Africa/Lagos">Africa/Lagos</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Africa/Libreville" ): ?> selected <?php endif; ?> value="Africa/Libreville">Africa/Libreville</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Africa/Lome" ): ?> selected <?php endif; ?> value="Africa/Lome">Africa/Lome</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Africa/Luanda" ): ?> selected <?php endif; ?> value="Africa/Luanda">Africa/Luanda</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Africa/Lubumbashi" ): ?> selected <?php endif; ?> value="Africa/Lubumbashi">Africa/Lubumbashi</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Africa/Lusaka" ): ?> selected <?php endif; ?> value="Africa/Lusaka">Africa/Lusaka</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Africa/Malabo" ): ?> selected <?php endif; ?> value="Africa/Malabo">Africa/Malabo</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Africa/Maputo" ): ?> selected <?php endif; ?> value="Africa/Maputo">Africa/Maputo</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Africa/Maseru" ): ?> selected <?php endif; ?> value="Africa/Maseru">Africa/Maseru</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Africa/Mbabane" ): ?> selected <?php endif; ?> value="Africa/Mbabane">Africa/Mbabane</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Africa/Mogadishu" ): ?> selected <?php endif; ?> value="Africa/Mogadishu">Africa/Mogadishu</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Africa/Monrovia" ): ?> selected <?php endif; ?> value="Africa/Monrovia">Africa/Monrovia</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Africa/Nairobi" ): ?> selected <?php endif; ?> value="Africa/Nairobi">Africa/Nairobi</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Africa/Ndjamena" ): ?> selected <?php endif; ?> value="Africa/Ndjamena">Africa/Ndjamena</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Africa/Niamey" ): ?> selected <?php endif; ?> value="Africa/Niamey">Africa/Niamey</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Africa/Nouakchott" ): ?> selected <?php endif; ?> value="Africa/Nouakchott">Africa/Nouakchott</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Africa/Ouagadougou" ): ?> selected <?php endif; ?> value="Africa/Ouagadougou">Africa/Ouagadougou</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Africa/Porto" ): ?> selected <?php endif; ?> value="Africa/Porto-Novo">Africa/Porto-Novo</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Africa/Sao_Tome" ): ?> selected <?php endif; ?> value="Africa/Sao_Tome">Africa/Sao_Tome</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Africa/Tripoli" ): ?> selected <?php endif; ?> value="Africa/Tripoli">Africa/Tripoli</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Africa/Tunis" ): ?> selected <?php endif; ?> value="Africa/Tunis">Africa/Tunis</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Africa/Windhoek" ): ?> selected <?php endif; ?> value="Africa/Windhoek">Africa/Windhoek</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Adak" ): ?> selected <?php endif; ?> value="America/Adak">America/Adak</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Anchorage" ): ?> selected <?php endif; ?> value="America/Anchorage">America/Anchorage</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Anguilla" ): ?> selected <?php endif; ?> value="America/Anguilla">America/Anguilla</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Antigua" ): ?> selected <?php endif; ?> value="America/Antigua">America/Antigua</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Araguaina" ): ?> selected <?php endif; ?> value="America/Araguaina">America/Araguaina</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Argentina" ): ?> selected <?php endif; ?> value="America/Argentina/Buenos_Aires">America/Argentina/Buenos_Aires</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Argentina" ): ?> selected <?php endif; ?> value="America/Argentina/Catamarca">America/Argentina/Catamarca</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Argentina" ): ?> selected <?php endif; ?> value="America/Argentina/Cordoba">America/Argentina/Cordoba</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Argentina" ): ?> selected <?php endif; ?> value="America/Argentina/Jujuy">America/Argentina/Jujuy</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Argentina" ): ?> selected <?php endif; ?> value="America/Argentina/La_Rioja">America/Argentina/La_Rioja</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Argentina" ): ?> selected <?php endif; ?> value="America/Argentina/Mendoza">America/Argentina/Mendoza</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Argentina" ): ?> selected <?php endif; ?> value="America/Argentina/Rio_Gallegos">America/Argentina/Rio_Gallegos</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Argentina" ): ?> selected <?php endif; ?> value="America/Argentina/Salta">America/Argentina/Salta</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Argentina" ): ?> selected <?php endif; ?> value="America/Argentina/San_Juan">America/Argentina/San_Juan</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Argentina" ): ?> selected <?php endif; ?> value="America/Argentina/San_Luis">America/Argentina/San_Luis</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Argentina" ): ?> selected <?php endif; ?> value="America/Argentina/Tucuman">America/Argentina/Tucuman</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Argentina" ): ?> selected <?php endif; ?> value="America/Argentina/Ushuaia">America/Argentina/Ushuaia</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Aruba" ): ?> selected <?php endif; ?> value="America/Aruba">America/Aruba</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Asuncion" ): ?> selected <?php endif; ?> value="America/Asuncion">America/Asuncion</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Atikokan" ): ?> selected <?php endif; ?> value="America/Atikokan">America/Atikokan</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Bahia" ): ?> selected <?php endif; ?> value="America/Bahia">America/Bahia</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Bahia_Banderas" ): ?> selected <?php endif; ?> value="America/Bahia_Banderas">America/Bahia_Banderas</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Barbados" ): ?> selected <?php endif; ?> value="America/Barbados">America/Barbados</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Belem" ): ?> selected <?php endif; ?> value="America/Belem">America/Belem</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Belize" ): ?> selected <?php endif; ?> value="America/Belize">America/Belize</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Blanc" ): ?> selected <?php endif; ?> value="America/Blanc-Sablon">America/Blanc-Sablon</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Boa_Vista" ): ?> selected <?php endif; ?> value="America/Boa_Vista">America/Boa_Vista</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Bogota" ): ?> selected <?php endif; ?> value="America/Bogota">America/Bogota</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Boise" ): ?> selected <?php endif; ?> value="America/Boise">America/Boise</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Cambridge_Bay" ): ?> selected <?php endif; ?> value="America/Cambridge_Bay">America/Cambridge_Bay</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Campo_Grande" ): ?> selected <?php endif; ?> value="America/Campo_Grande">America/Campo_Grande</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Cancun" ): ?> selected <?php endif; ?> value="America/Cancun">America/Cancun</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Caracas" ): ?> selected <?php endif; ?> value="America/Caracas">America/Caracas</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Cayenne" ): ?> selected <?php endif; ?> value="America/Cayenne">America/Cayenne</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Cayman" ): ?> selected <?php endif; ?> value="America/Cayman">America/Cayman</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Chicago" ): ?> selected <?php endif; ?> value="America/Chicago">America/Chicago</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Chihuahua" ): ?> selected <?php endif; ?> value="America/Chihuahua">America/Chihuahua</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Ciudad_Juarez" ): ?> selected <?php endif; ?> value="America/Ciudad_Juarez">America/Ciudad_Juarez</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Costa_Rica" ): ?> selected <?php endif; ?> value="America/Costa_Rica">America/Costa_Rica</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Creston" ): ?> selected <?php endif; ?> value="America/Creston">America/Creston</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Cuiaba" ): ?> selected <?php endif; ?> value="America/Cuiaba">America/Cuiaba</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Curacao" ): ?> selected <?php endif; ?> value="America/Curacao">America/Curacao</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Danmarkshavn" ): ?> selected <?php endif; ?> value="America/Danmarkshavn">America/Danmarkshavn</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Dawson" ): ?> selected <?php endif; ?> value="America/Dawson">America/Dawson</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Dawson_Creek" ): ?> selected <?php endif; ?> value="America/Dawson_Creek">America/Dawson_Creek</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Denver" ): ?> selected <?php endif; ?> value="America/Denver">America/Denver</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Detroit" ): ?> selected <?php endif; ?> value="America/Detroit">America/Detroit</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Dominica" ): ?> selected <?php endif; ?> value="America/Dominica">America/Dominica</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Edmonton" ): ?> selected <?php endif; ?> value="America/Edmonton">America/Edmonton</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Eirunepe" ): ?> selected <?php endif; ?> value="America/Eirunepe">America/Eirunepe</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/El_Salvador" ): ?> selected <?php endif; ?> value="America/El_Salvador">America/El_Salvador</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Fort_Nelson" ): ?> selected <?php endif; ?> value="America/Fort_Nelson">America/Fort_Nelson</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Fortaleza" ): ?> selected <?php endif; ?> value="America/Fortaleza">America/Fortaleza</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Glace_Bay" ): ?> selected <?php endif; ?> value="America/Glace_Bay">America/Glace_Bay</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Goose_Bay" ): ?> selected <?php endif; ?> value="America/Goose_Bay">America/Goose_Bay</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Grand_Turk" ): ?> selected <?php endif; ?> value="America/Grand_Turk">America/Grand_Turk</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Grenada" ): ?> selected <?php endif; ?> value="America/Grenada">America/Grenada</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Guadeloupe" ): ?> selected <?php endif; ?> value="America/Guadeloupe">America/Guadeloupe</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Guatemala" ): ?> selected <?php endif; ?> value="America/Guatemala">America/Guatemala</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Guayaquil" ): ?> selected <?php endif; ?> value="America/Guayaquil">America/Guayaquil</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Guyana" ): ?> selected <?php endif; ?> value="America/Guyana">America/Guyana</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Halifax" ): ?> selected <?php endif; ?> value="America/Halifax">America/Halifax</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Havana" ): ?> selected <?php endif; ?> value="America/Havana">America/Havana</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Hermosillo" ): ?> selected <?php endif; ?> value="America/Hermosillo">America/Hermosillo</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Indiana" ): ?> selected <?php endif; ?> value="America/Indiana/Indianapolis">America/Indiana/Indianapolis</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Indiana" ): ?> selected <?php endif; ?> value="America/Indiana/Knox">America/Indiana/Knox</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Indiana" ): ?> selected <?php endif; ?> value="America/Indiana/Marengo">America/Indiana/Marengo</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Indiana" ): ?> selected <?php endif; ?> value="America/Indiana/Petersburg">America/Indiana/Petersburg</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Indiana" ): ?> selected <?php endif; ?> value="America/Indiana/Tell_City">America/Indiana/Tell_City</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Indiana" ): ?> selected <?php endif; ?> value="America/Indiana/Vevay">America/Indiana/Vevay</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Indiana" ): ?> selected <?php endif; ?> value="America/Indiana/Vincennes">America/Indiana/Vincennes</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Indiana" ): ?> selected <?php endif; ?> value="America/Indiana/Winamac">America/Indiana/Winamac</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Inuvik" ): ?> selected <?php endif; ?> value="America/Inuvik">America/Inuvik</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Iqaluit" ): ?> selected <?php endif; ?> value="America/Iqaluit">America/Iqaluit</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Jamaica" ): ?> selected <?php endif; ?> value="America/Jamaica">America/Jamaica</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Juneau" ): ?> selected <?php endif; ?> value="America/Juneau">America/Juneau</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Kentucky" ): ?> selected <?php endif; ?> value="America/Kentucky/Louisville">America/Kentucky/Louisville</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Kentucky" ): ?> selected <?php endif; ?> value="America/Kentucky/Monticello">America/Kentucky/Monticello</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Kralendijk" ): ?> selected <?php endif; ?> value="America/Kralendijk">America/Kralendijk</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/La_Paz" ): ?> selected <?php endif; ?> value="America/La_Paz">America/La_Paz</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Lima" ): ?> selected <?php endif; ?> value="America/Lima">America/Lima</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Los_Angeles" ): ?> selected <?php endif; ?> value="America/Los_Angeles">America/Los_Angeles</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Lower_Princes" ): ?> selected <?php endif; ?> value="America/Lower_Princes">America/Lower_Princes</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Maceio" ): ?> selected <?php endif; ?> value="America/Maceio">America/Maceio</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Managua" ): ?> selected <?php endif; ?> value="America/Managua">America/Managua</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Manaus" ): ?> selected <?php endif; ?> value="America/Manaus">America/Manaus</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Marigot" ): ?> selected <?php endif; ?> value="America/Marigot">America/Marigot</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Martinique" ): ?> selected <?php endif; ?> value="America/Martinique">America/Martinique</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Matamoros" ): ?> selected <?php endif; ?> value="America/Matamoros">America/Matamoros</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Mazatlan" ): ?> selected <?php endif; ?> value="America/Mazatlan">America/Mazatlan</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Menominee" ): ?> selected <?php endif; ?> value="America/Menominee">America/Menominee</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Merida" ): ?> selected <?php endif; ?> value="America/Merida">America/Merida</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Metlakatla" ): ?> selected <?php endif; ?> value="America/Metlakatla">America/Metlakatla</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Mexico_City" ): ?> selected <?php endif; ?> value="America/Mexico_City">America/Mexico_City</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Miquelon" ): ?> selected <?php endif; ?> value="America/Miquelon">America/Miquelon</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Moncton" ): ?> selected <?php endif; ?> value="America/Moncton">America/Moncton</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Monterrey" ): ?> selected <?php endif; ?> value="America/Monterrey">America/Monterrey</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Montevideo" ): ?> selected <?php endif; ?> value="America/Montevideo">America/Montevideo</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Montserrat" ): ?> selected <?php endif; ?> value="America/Montserrat">America/Montserrat</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Nassau" ): ?> selected <?php endif; ?> value="America/Nassau">America/Nassau</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/New_York" ): ?> selected <?php endif; ?> value="America/New_York">America/New_York</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Nome" ): ?> selected <?php endif; ?> value="America/Nome">America/Nome</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Noronha" ): ?> selected <?php endif; ?> value="America/Noronha">America/Noronha</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/North_Dakota" ): ?> selected <?php endif; ?> value="America/North_Dakota/Beulah">America/North_Dakota/Beulah</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/North_Dakota" ): ?> selected <?php endif; ?> value="America/North_Dakota/Center">America/North_Dakota/Center</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/North_Dakota" ): ?> selected <?php endif; ?> value="America/North_Dakota/New_Salem">America/North_Dakota/New_Salem</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Nuuk" ): ?> selected <?php endif; ?> value="America/Nuuk">America/Nuuk</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Ojinaga" ): ?> selected <?php endif; ?> value="America/Ojinaga">America/Ojinaga</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Panama" ): ?> selected <?php endif; ?> value="America/Panama">America/Panama</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Paramaribo" ): ?> selected <?php endif; ?> value="America/Paramaribo">America/Paramaribo</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Phoenix" ): ?> selected <?php endif; ?> value="America/Phoenix">America/Phoenix</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Port" ): ?> selected <?php endif; ?> value="America/Port-au-Prince">America/Port-au-Prince</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Port_of_Spain" ): ?> selected <?php endif; ?> value="America/Port_of_Spain">America/Port_of_Spain</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Porto_Velho" ): ?> selected <?php endif; ?> value="America/Porto_Velho">America/Porto_Velho</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Puerto_Rico" ): ?> selected <?php endif; ?> value="America/Puerto_Rico">America/Puerto_Rico</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Punta_Arenas" ): ?> selected <?php endif; ?> value="America/Punta_Arenas">America/Punta_Arenas</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Rankin_Inlet" ): ?> selected <?php endif; ?> value="America/Rankin_Inlet">America/Rankin_Inlet</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Recife" ): ?> selected <?php endif; ?> value="America/Recife">America/Recife</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Regina" ): ?> selected <?php endif; ?> value="America/Regina">America/Regina</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Resolute" ): ?> selected <?php endif; ?> value="America/Resolute">America/Resolute</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Rio_Branco" ): ?> selected <?php endif; ?> value="America/Rio_Branco">America/Rio_Branco</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Santarem" ): ?> selected <?php endif; ?> value="America/Santarem">America/Santarem</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Santiago" ): ?> selected <?php endif; ?> value="America/Santiago">America/Santiago</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Santo_Domingo" ): ?> selected <?php endif; ?> value="America/Santo_Domingo">America/Santo_Domingo</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Sao_Paulo" ): ?> selected <?php endif; ?> value="America/Sao_Paulo">America/Sao_Paulo</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Scoresbysund" ): ?> selected <?php endif; ?> value="America/Scoresbysund">America/Scoresbysund</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Sitka" ): ?> selected <?php endif; ?> value="America/Sitka">America/Sitka</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/St_Barthelemy" ): ?> selected <?php endif; ?> value="America/St_Barthelemy">America/St_Barthelemy</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/St_Johns" ): ?> selected <?php endif; ?> value="America/St_Johns">America/St_Johns</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/St_Kitts" ): ?> selected <?php endif; ?> value="America/St_Kitts">America/St_Kitts</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/St_Lucia" ): ?> selected <?php endif; ?> value="America/St_Lucia">America/St_Lucia</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/St_Thomas" ): ?> selected <?php endif; ?> value="America/St_Thomas">America/St_Thomas</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/St_Vincent" ): ?> selected <?php endif; ?> value="America/St_Vincent">America/St_Vincent</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Swift_Current" ): ?> selected <?php endif; ?> value="America/Swift_Current">America/Swift_Current</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Tegucigalpa" ): ?> selected <?php endif; ?> value="America/Tegucigalpa">America/Tegucigalpa</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Thule" ): ?> selected <?php endif; ?> value="America/Thule">America/Thule</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Tijuana" ): ?> selected <?php endif; ?> value="America/Tijuana">America/Tijuana</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Toronto" ): ?> selected <?php endif; ?> value="America/Toronto">America/Toronto</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Tortola" ): ?> selected <?php endif; ?> value="America/Tortola">America/Tortola</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Vancouver" ): ?> selected <?php endif; ?> value="America/Vancouver">America/Vancouver</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Whitehorse" ): ?> selected <?php endif; ?> value="America/Whitehorse">America/Whitehorse</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Winnipeg" ): ?> selected <?php endif; ?> value="America/Winnipeg">America/Winnipeg</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "America/Yakutat" ): ?> selected <?php endif; ?> value="America/Yakutat">America/Yakutat</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Antarctica/Casey" ): ?> selected <?php endif; ?> value="Antarctica/Casey">Antarctica/Casey</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Antarctica/Davis" ): ?> selected <?php endif; ?> value="Antarctica/Davis">Antarctica/Davis</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Antarctica/DumontDUrville" ): ?> selected <?php endif; ?> value="Antarctica/DumontDUrville">Antarctica/DumontDUrville</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Antarctica/Macquarie" ): ?> selected <?php endif; ?> value="Antarctica/Macquarie">Antarctica/Macquarie</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Antarctica/Mawson" ): ?> selected <?php endif; ?> value="Antarctica/Mawson">Antarctica/Mawson</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Antarctica/McMurdo" ): ?> selected <?php endif; ?> value="Antarctica/McMurdo">Antarctica/McMurdo</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Antarctica/Palmer" ): ?> selected <?php endif; ?> value="Antarctica/Palmer">Antarctica/Palmer</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Antarctica/Rothera" ): ?> selected <?php endif; ?> value="Antarctica/Rothera">Antarctica/Rothera</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Antarctica/Syowa" ): ?> selected <?php endif; ?> value="Antarctica/Syowa">Antarctica/Syowa</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Antarctica/Troll" ): ?> selected <?php endif; ?> value="Antarctica/Troll">Antarctica/Troll</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Antarctica/Vostok" ): ?> selected <?php endif; ?> value="Antarctica/Vostok">Antarctica/Vostok</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Arctic/Longyearbyen" ): ?> selected <?php endif; ?> value="Arctic/Longyearbyen">Arctic/Longyearbyen</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Asia/Aden" ): ?> selected <?php endif; ?> value="Asia/Aden">Asia/Aden</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Asia/Almaty" ): ?> selected <?php endif; ?> value="Asia/Almaty">Asia/Almaty</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Asia/Amman" ): ?> selected <?php endif; ?> value="Asia/Amman">Asia/Amman</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Asia/Anadyr" ): ?> selected <?php endif; ?> value="Asia/Anadyr">Asia/Anadyr</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Asia/Aqtau" ): ?> selected <?php endif; ?> value="Asia/Aqtau">Asia/Aqtau</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Asia/Aqtobe" ): ?> selected <?php endif; ?> value="Asia/Aqtobe">Asia/Aqtobe</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Asia/Ashgabat" ): ?> selected <?php endif; ?> value="Asia/Ashgabat">Asia/Ashgabat</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Asia/Atyrau" ): ?> selected <?php endif; ?> value="Asia/Atyrau">Asia/Atyrau</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Asia/Baghdad" ): ?> selected <?php endif; ?> value="Asia/Baghdad">Asia/Baghdad</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Asia/Bahrain" ): ?> selected <?php endif; ?> value="Asia/Bahrain">Asia/Bahrain</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Asia/Baku" ): ?> selected <?php endif; ?> value="Asia/Baku">Asia/Baku</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Asia/Bangkok" ): ?> selected <?php endif; ?> value="Asia/Bangkok">Asia/Bangkok</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Asia/Barnaul" ): ?> selected <?php endif; ?> value="Asia/Barnaul">Asia/Barnaul</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Asia/Beirut" ): ?> selected <?php endif; ?> value="Asia/Beirut">Asia/Beirut</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Asia/Bishkek" ): ?> selected <?php endif; ?> value="Asia/Bishkek">Asia/Bishkek</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Asia/Brunei" ): ?> selected <?php endif; ?> value="Asia/Brunei">Asia/Brunei</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Asia/Chita" ): ?> selected <?php endif; ?> value="Asia/Chita">Asia/Chita</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Asia/Choibalsan" ): ?> selected <?php endif; ?> value="Asia/Choibalsan">Asia/Choibalsan</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Asia/Colombo" ): ?> selected <?php endif; ?> value="Asia/Colombo">Asia/Colombo</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Asia/Damascus" ): ?> selected <?php endif; ?> value="Asia/Damascus">Asia/Damascus</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Asia/Dhaka" ): ?> selected <?php endif; ?> value="Asia/Dhaka">Asia/Dhaka</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Asia/Dili" ): ?> selected <?php endif; ?> value="Asia/Dili">Asia/Dili</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Asia/Dubai" ): ?> selected <?php endif; ?> value="Asia/Dubai">Asia/Dubai</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Asia/Dushanbe" ): ?> selected <?php endif; ?> value="Asia/Dushanbe">Asia/Dushanbe</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Asia/Famagusta" ): ?> selected <?php endif; ?> value="Asia/Famagusta">Asia/Famagusta</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Asia/Gaza" ): ?> selected <?php endif; ?> value="Asia/Gaza">Asia/Gaza</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Asia/Hebron" ): ?> selected <?php endif; ?> value="Asia/Hebron">Asia/Hebron</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Asia/Ho_Chi_Minh" ): ?> selected <?php endif; ?> value="Asia/Ho_Chi_Minh">Asia/Ho_Chi_Minh</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Asia/Hong_Kong" ): ?> selected <?php endif; ?> value="Asia/Hong_Kong">Asia/Hong_Kong</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Asia/Hovd" ): ?> selected <?php endif; ?> value="Asia/Hovd">Asia/Hovd</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Asia/Irkutsk" ): ?> selected <?php endif; ?> value="Asia/Irkutsk">Asia/Irkutsk</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Asia/Jakarta" ): ?> selected <?php endif; ?> value="Asia/Jakarta">Asia/Jakarta</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Asia/Jayapura" ): ?> selected <?php endif; ?> value="Asia/Jayapura">Asia/Jayapura</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Asia/Jerusalem" ): ?> selected <?php endif; ?> value="Asia/Jerusalem">Asia/Jerusalem</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Asia/Kabul" ): ?> selected <?php endif; ?> value="Asia/Kabul">Asia/Kabul</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Asia/Kamchatka" ): ?> selected <?php endif; ?> value="Asia/Kamchatka">Asia/Kamchatka</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Asia/Karachi" ): ?> selected <?php endif; ?> value="Asia/Karachi">Asia/Karachi</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Asia/Kathmandu" ): ?> selected <?php endif; ?> value="Asia/Kathmandu">Asia/Kathmandu</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Asia/Khandyga" ): ?> selected <?php endif; ?> value="Asia/Khandyga">Asia/Khandyga</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Asia/Kolkata" ): ?> selected <?php endif; ?> value="Asia/Kolkata">Asia/Kolkata</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Asia/Krasnoyarsk" ): ?> selected <?php endif; ?> value="Asia/Krasnoyarsk">Asia/Krasnoyarsk</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Asia/Kuala_Lumpur" ): ?> selected <?php endif; ?> value="Asia/Kuala_Lumpur">Asia/Kuala_Lumpur</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Asia/Kuching" ): ?> selected <?php endif; ?> value="Asia/Kuching">Asia/Kuching</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Asia/Kuwait" ): ?> selected <?php endif; ?> value="Asia/Kuwait">Asia/Kuwait</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Asia/Macau" ): ?> selected <?php endif; ?> value="Asia/Macau">Asia/Macau</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Asia/Magadan" ): ?> selected <?php endif; ?> value="Asia/Magadan">Asia/Magadan</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Asia/Makassar" ): ?> selected <?php endif; ?> value="Asia/Makassar">Asia/Makassar</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Asia/Manila" ): ?> selected <?php endif; ?> value="Asia/Manila">Asia/Manila</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Asia/Muscat" ): ?> selected <?php endif; ?> value="Asia/Muscat">Asia/Muscat</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Asia/Nicosia" ): ?> selected <?php endif; ?> value="Asia/Nicosia">Asia/Nicosia</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Asia/Novokuznetsk" ): ?> selected <?php endif; ?> value="Asia/Novokuznetsk">Asia/Novokuznetsk</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Asia/Novosibirsk" ): ?> selected <?php endif; ?> value="Asia/Novosibirsk">Asia/Novosibirsk</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Asia/Omsk" ): ?> selected <?php endif; ?> value="Asia/Omsk">Asia/Omsk</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Asia/Oral" ): ?> selected <?php endif; ?> value="Asia/Oral">Asia/Oral</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Asia/Phnom_Penh" ): ?> selected <?php endif; ?> value="Asia/Phnom_Penh">Asia/Phnom_Penh</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Asia/Pontianak" ): ?> selected <?php endif; ?> value="Asia/Pontianak">Asia/Pontianak</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Asia/Pyongyang" ): ?> selected <?php endif; ?> value="Asia/Pyongyang">Asia/Pyongyang</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Asia/Qatar" ): ?> selected <?php endif; ?> value="Asia/Qatar">Asia/Qatar</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Asia/Qostanay" ): ?> selected <?php endif; ?> value="Asia/Qostanay">Asia/Qostanay</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Asia/Qyzylorda" ): ?> selected <?php endif; ?> value="Asia/Qyzylorda">Asia/Qyzylorda</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Asia/Riyadh" ): ?> selected <?php endif; ?> value="Asia/Riyadh">Asia/Riyadh</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Asia/Sakhalin" ): ?> selected <?php endif; ?> value="Asia/Sakhalin">Asia/Sakhalin</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Asia/Samarkand" ): ?> selected <?php endif; ?> value="Asia/Samarkand">Asia/Samarkand</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Asia/Seoul" ): ?> selected <?php endif; ?> value="Asia/Seoul">Asia/Seoul</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Asia/Shanghai" ): ?> selected <?php endif; ?> value="Asia/Shanghai">Asia/Shanghai</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Asia/Singapore" ): ?> selected <?php endif; ?> value="Asia/Singapore">Asia/Singapore</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Asia/Srednekolymsk" ): ?> selected <?php endif; ?> value="Asia/Srednekolymsk">Asia/Srednekolymsk</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Asia/Taipei" ): ?> selected <?php endif; ?> value="Asia/Taipei">Asia/Taipei</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Asia/Tashkent" ): ?> selected <?php endif; ?> value="Asia/Tashkent">Asia/Tashkent</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Asia/Tbilisi" ): ?> selected <?php endif; ?> value="Asia/Tbilisi">Asia/Tbilisi</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Asia/Tehran" ): ?> selected <?php endif; ?> value="Asia/Tehran">Asia/Tehran</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Asia/Thimphu" ): ?> selected <?php endif; ?> value="Asia/Thimphu">Asia/Thimphu</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Asia/Tokyo" ): ?> selected <?php endif; ?> value="Asia/Tokyo">Asia/Tokyo</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Asia/Tomsk" ): ?> selected <?php endif; ?> value="Asia/Tomsk">Asia/Tomsk</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Asia/Ulaanbaatar" ): ?> selected <?php endif; ?> value="Asia/Ulaanbaatar">Asia/Ulaanbaatar</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Asia/Urumqi" ): ?> selected <?php endif; ?> value="Asia/Urumqi">Asia/Urumqi</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Asia/Ust" ): ?> selected <?php endif; ?> value="Asia/Ust-Nera">Asia/Ust-Nera</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Asia/Vientiane" ): ?> selected <?php endif; ?> value="Asia/Vientiane">Asia/Vientiane</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Asia/Vladivostok" ): ?> selected <?php endif; ?> value="Asia/Vladivostok">Asia/Vladivostok</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Asia/Yakutsk" ): ?> selected <?php endif; ?> value="Asia/Yakutsk">Asia/Yakutsk</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Asia/Yangon" ): ?> selected <?php endif; ?> value="Asia/Yangon">Asia/Yangon</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Asia/Yekaterinburg" ): ?> selected <?php endif; ?> value="Asia/Yekaterinburg">Asia/Yekaterinburg</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Asia/Yerevan" ): ?> selected <?php endif; ?> value="Asia/Yerevan">Asia/Yerevan</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Atlantic/Azores" ): ?> selected <?php endif; ?> value="Atlantic/Azores">Atlantic/Azores</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Atlantic/Bermuda" ): ?> selected <?php endif; ?> value="Atlantic/Bermuda">Atlantic/Bermuda</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Atlantic/Canary" ): ?> selected <?php endif; ?> value="Atlantic/Canary">Atlantic/Canary</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Atlantic/Cape_Verde" ): ?> selected <?php endif; ?> value="Atlantic/Cape_Verde">Atlantic/Cape_Verde</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Atlantic/Faroe" ): ?> selected <?php endif; ?> value="Atlantic/Faroe">Atlantic/Faroe</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Atlantic/Madeira" ): ?> selected <?php endif; ?> value="Atlantic/Madeira">Atlantic/Madeira</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Atlantic/Reykjavik" ): ?> selected <?php endif; ?> value="Atlantic/Reykjavik">Atlantic/Reykjavik</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Atlantic/South_Georgia" ): ?> selected <?php endif; ?> value="Atlantic/South_Georgia">Atlantic/South_Georgia</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Atlantic/St_Helena" ): ?> selected <?php endif; ?> value="Atlantic/St_Helena">Atlantic/St_Helena</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Atlantic/Stanley" ): ?> selected <?php endif; ?> value="Atlantic/Stanley">Atlantic/Stanley</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Australia/Adelaide" ): ?> selected <?php endif; ?> value="Australia/Adelaide">Australia/Adelaide</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Australia/Brisbane" ): ?> selected <?php endif; ?> value="Australia/Brisbane">Australia/Brisbane</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Australia/Broken_Hill" ): ?> selected <?php endif; ?> value="Australia/Broken_Hill">Australia/Broken_Hill</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Australia/Darwin" ): ?> selected <?php endif; ?> value="Australia/Darwin">Australia/Darwin</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Australia/Eucla" ): ?> selected <?php endif; ?> value="Australia/Eucla">Australia/Eucla</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Australia/Hobart" ): ?> selected <?php endif; ?> value="Australia/Hobart">Australia/Hobart</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Australia/Lindeman" ): ?> selected <?php endif; ?> value="Australia/Lindeman">Australia/Lindeman</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Australia/Lord_Howe" ): ?> selected <?php endif; ?> value="Australia/Lord_Howe">Australia/Lord_Howe</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Australia/Melbourne" ): ?> selected <?php endif; ?> value="Australia/Melbourne">Australia/Melbourne</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Australia/Perth" ): ?> selected <?php endif; ?> value="Australia/Perth">Australia/Perth</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Australia/Sydney" ): ?> selected <?php endif; ?> value="Australia/Sydney">Australia/Sydney</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Europe/Amsterdam" ): ?> selected <?php endif; ?> value="Europe/Amsterdam">Europe/Amsterdam</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Europe/Andorra" ): ?> selected <?php endif; ?> value="Europe/Andorra">Europe/Andorra</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Europe/Astrakhan" ): ?> selected <?php endif; ?> value="Europe/Astrakhan">Europe/Astrakhan</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Europe/Athens" ): ?> selected <?php endif; ?> value="Europe/Athens">Europe/Athens</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Europe/Belgrade" ): ?> selected <?php endif; ?> value="Europe/Belgrade">Europe/Belgrade</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Europe/Berlin" ): ?> selected <?php endif; ?> value="Europe/Berlin">Europe/Berlin</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Europe/Bratislava" ): ?> selected <?php endif; ?> value="Europe/Bratislava">Europe/Bratislava</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Europe/Brussels" ): ?> selected <?php endif; ?> value="Europe/Brussels">Europe/Brussels</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Europe/Bucharest" ): ?> selected <?php endif; ?> value="Europe/Bucharest">Europe/Bucharest</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Europe/Budapest" ): ?> selected <?php endif; ?> value="Europe/Budapest">Europe/Budapest</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Europe/Busingen" ): ?> selected <?php endif; ?> value="Europe/Busingen">Europe/Busingen</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Europe/Chisinau" ): ?> selected <?php endif; ?> value="Europe/Chisinau">Europe/Chisinau</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Europe/Copenhagen" ): ?> selected <?php endif; ?> value="Europe/Copenhagen">Europe/Copenhagen</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Europe/Dublin" ): ?> selected <?php endif; ?> value="Europe/Dublin">Europe/Dublin</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Europe/Gibraltar" ): ?> selected <?php endif; ?> value="Europe/Gibraltar">Europe/Gibraltar</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Europe/Guernsey" ): ?> selected <?php endif; ?> value="Europe/Guernsey">Europe/Guernsey</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Europe/Helsinki" ): ?> selected <?php endif; ?> value="Europe/Helsinki">Europe/Helsinki</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Europe/Isle_of_Man" ): ?> selected <?php endif; ?> value="Europe/Isle_of_Man">Europe/Isle_of_Man</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Europe/Istanbul" ): ?> selected <?php endif; ?> value="Europe/Istanbul">Europe/Istanbul</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Europe/Jersey" ): ?> selected <?php endif; ?> value="Europe/Jersey">Europe/Jersey</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Europe/Kaliningrad" ): ?> selected <?php endif; ?> value="Europe/Kaliningrad">Europe/Kaliningrad</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Europe/Kirov" ): ?> selected <?php endif; ?> value="Europe/Kirov">Europe/Kirov</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Europe/Kyiv" ): ?> selected <?php endif; ?> value="Europe/Kyiv">Europe/Kyiv</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Europe/Lisbon" ): ?> selected <?php endif; ?> value="Europe/Lisbon">Europe/Lisbon</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Europe/Ljubljana" ): ?> selected <?php endif; ?> value="Europe/Ljubljana">Europe/Ljubljana</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Europe/London" ): ?> selected <?php endif; ?> value="Europe/London">Europe/London</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Europe/Luxembourg" ): ?> selected <?php endif; ?> value="Europe/Luxembourg">Europe/Luxembourg</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Europe/Madrid" ): ?> selected <?php endif; ?> value="Europe/Madrid">Europe/Madrid</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Europe/Malta" ): ?> selected <?php endif; ?> value="Europe/Malta">Europe/Malta</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Europe/Mariehamn" ): ?> selected <?php endif; ?> value="Europe/Mariehamn">Europe/Mariehamn</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Europe/Minsk" ): ?> selected <?php endif; ?> value="Europe/Minsk">Europe/Minsk</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Europe/Monaco" ): ?> selected <?php endif; ?> value="Europe/Monaco">Europe/Monaco</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Europe/Moscow" ): ?> selected <?php endif; ?> value="Europe/Moscow">Europe/Moscow</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Europe/Oslo" ): ?> selected <?php endif; ?> value="Europe/Oslo">Europe/Oslo</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Europe/Paris" ): ?> selected <?php endif; ?> value="Europe/Paris">Europe/Paris</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Europe/Podgorica" ): ?> selected <?php endif; ?> value="Europe/Podgorica">Europe/Podgorica</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Europe/Prague" ): ?> selected <?php endif; ?> value="Europe/Prague">Europe/Prague</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Europe/Riga" ): ?> selected <?php endif; ?> value="Europe/Riga">Europe/Riga</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Europe/Rome" ): ?> selected <?php endif; ?> value="Europe/Rome">Europe/Rome</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Europe/Samara" ): ?> selected <?php endif; ?> value="Europe/Samara">Europe/Samara</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Europe/San_Marino" ): ?> selected <?php endif; ?> value="Europe/San_Marino">Europe/San_Marino</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Europe/Sarajevo" ): ?> selected <?php endif; ?> value="Europe/Sarajevo">Europe/Sarajevo</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Europe/Saratov" ): ?> selected <?php endif; ?> value="Europe/Saratov">Europe/Saratov</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Europe/Simferopol" ): ?> selected <?php endif; ?> value="Europe/Simferopol">Europe/Simferopol</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Europe/Skopje" ): ?> selected <?php endif; ?> value="Europe/Skopje">Europe/Skopje</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Europe/Sofia" ): ?> selected <?php endif; ?> value="Europe/Sofia">Europe/Sofia</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Europe/Stockholm" ): ?> selected <?php endif; ?> value="Europe/Stockholm">Europe/Stockholm</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Europe/Tallinn" ): ?> selected <?php endif; ?> value="Europe/Tallinn">Europe/Tallinn</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Europe/Tirane" ): ?> selected <?php endif; ?> value="Europe/Tirane">Europe/Tirane</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Europe/Ulyanovsk" ): ?> selected <?php endif; ?> value="Europe/Ulyanovsk">Europe/Ulyanovsk</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Europe/Vaduz" ): ?> selected <?php endif; ?> value="Europe/Vaduz">Europe/Vaduz</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Europe/Vatican" ): ?> selected <?php endif; ?> value="Europe/Vatican">Europe/Vatican</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Europe/Vienna" ): ?> selected <?php endif; ?> value="Europe/Vienna">Europe/Vienna</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Europe/Vilnius" ): ?> selected <?php endif; ?> value="Europe/Vilnius">Europe/Vilnius</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Europe/Volgograd" ): ?> selected <?php endif; ?> value="Europe/Volgograd">Europe/Volgograd</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Europe/Warsaw" ): ?> selected <?php endif; ?> value="Europe/Warsaw">Europe/Warsaw</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Europe/Zagreb" ): ?> selected <?php endif; ?> value="Europe/Zagreb">Europe/Zagreb</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Europe/Zurich" ): ?> selected <?php endif; ?> value="Europe/Zurich">Europe/Zurich</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Indian/Antananarivo" ): ?> selected <?php endif; ?> value="Indian/Antananarivo">Indian/Antananarivo</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Indian/Chagos" ): ?> selected <?php endif; ?> value="Indian/Chagos">Indian/Chagos</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Indian/Christmas" ): ?> selected <?php endif; ?> value="Indian/Christmas">Indian/Christmas</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Indian/Cocos" ): ?> selected <?php endif; ?> value="Indian/Cocos">Indian/Cocos</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Indian/Comoro" ): ?> selected <?php endif; ?> value="Indian/Comoro">Indian/Comoro</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Indian/Kerguelen" ): ?> selected <?php endif; ?> value="Indian/Kerguelen">Indian/Kerguelen</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Indian/Mahe" ): ?> selected <?php endif; ?> value="Indian/Mahe">Indian/Mahe</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Indian/Maldives" ): ?> selected <?php endif; ?> value="Indian/Maldives">Indian/Maldives</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Indian/Mauritius" ): ?> selected <?php endif; ?> value="Indian/Mauritius">Indian/Mauritius</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Indian/Mayotte" ): ?> selected <?php endif; ?> value="Indian/Mayotte">Indian/Mayotte</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Indian/Reunion" ): ?> selected <?php endif; ?> value="Indian/Reunion">Indian/Reunion</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Pacific/Apia" ): ?> selected <?php endif; ?> value="Pacific/Apia">Pacific/Apia</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Pacific/Auckland" ): ?> selected <?php endif; ?> value="Pacific/Auckland">Pacific/Auckland</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Pacific/Bougainville" ): ?> selected <?php endif; ?> value="Pacific/Bougainville">Pacific/Bougainville</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Pacific/Chatham" ): ?> selected <?php endif; ?> value="Pacific/Chatham">Pacific/Chatham</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Pacific/Chuuk" ): ?> selected <?php endif; ?> value="Pacific/Chuuk">Pacific/Chuuk</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Pacific/Easter" ): ?> selected <?php endif; ?> value="Pacific/Easter">Pacific/Easter</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Pacific/Efate" ): ?> selected <?php endif; ?> value="Pacific/Efate">Pacific/Efate</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Pacific/Fakaofo" ): ?> selected <?php endif; ?> value="Pacific/Fakaofo">Pacific/Fakaofo</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Pacific/Fiji" ): ?> selected <?php endif; ?> value="Pacific/Fiji">Pacific/Fiji</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Pacific/Funafuti" ): ?> selected <?php endif; ?> value="Pacific/Funafuti">Pacific/Funafuti</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Pacific/Galapagos" ): ?> selected <?php endif; ?> value="Pacific/Galapagos">Pacific/Galapagos</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Pacific/Gambier" ): ?> selected <?php endif; ?> value="Pacific/Gambier">Pacific/Gambier</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Pacific/Guadalcanal" ): ?> selected <?php endif; ?> value="Pacific/Guadalcanal">Pacific/Guadalcanal</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Pacific/Guam" ): ?> selected <?php endif; ?> value="Pacific/Guam">Pacific/Guam</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Pacific/Honolulu" ): ?> selected <?php endif; ?> value="Pacific/Honolulu">Pacific/Honolulu</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Pacific/Kanton" ): ?> selected <?php endif; ?> value="Pacific/Kanton">Pacific/Kanton</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Pacific/Kiritimati" ): ?> selected <?php endif; ?> value="Pacific/Kiritimati">Pacific/Kiritimati</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Pacific/Kosrae" ): ?> selected <?php endif; ?> value="Pacific/Kosrae">Pacific/Kosrae</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Pacific/Kwajalein" ): ?> selected <?php endif; ?> value="Pacific/Kwajalein">Pacific/Kwajalein</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Pacific/Majuro" ): ?> selected <?php endif; ?> value="Pacific/Majuro">Pacific/Majuro</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Pacific/Marquesas" ): ?> selected <?php endif; ?> value="Pacific/Marquesas">Pacific/Marquesas</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Pacific/Midway" ): ?> selected <?php endif; ?> value="Pacific/Midway">Pacific/Midway</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Pacific/Nauru" ): ?> selected <?php endif; ?> value="Pacific/Nauru">Pacific/Nauru</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Pacific/Niue" ): ?> selected <?php endif; ?> value="Pacific/Niue">Pacific/Niue</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Pacific/Norfolk" ): ?> selected <?php endif; ?> value="Pacific/Norfolk">Pacific/Norfolk</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Pacific/Noumea" ): ?> selected <?php endif; ?> value="Pacific/Noumea">Pacific/Noumea</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Pacific/Pago_Pago" ): ?> selected <?php endif; ?> value="Pacific/Pago_Pago">Pacific/Pago_Pago</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Pacific/Palau" ): ?> selected <?php endif; ?> value="Pacific/Palau">Pacific/Palau</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Pacific/Pitcairn" ): ?> selected <?php endif; ?> value="Pacific/Pitcairn">Pacific/Pitcairn</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Pacific/Pohnpei" ): ?> selected <?php endif; ?> value="Pacific/Pohnpei">Pacific/Pohnpei</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Pacific/Port_Moresby" ): ?> selected <?php endif; ?> value="Pacific/Port_Moresby">Pacific/Port_Moresby</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Pacific/Rarotonga" ): ?> selected <?php endif; ?> value="Pacific/Rarotonga">Pacific/Rarotonga</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Pacific/Saipan" ): ?> selected <?php endif; ?> value="Pacific/Saipan">Pacific/Saipan</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Pacific/Tahiti" ): ?> selected <?php endif; ?> value="Pacific/Tahiti">Pacific/Tahiti</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Pacific/Tarawa" ): ?> selected <?php endif; ?> value="Pacific/Tarawa">Pacific/Tarawa</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Pacific/Tongatapu" ): ?> selected <?php endif; ?> value="Pacific/Tongatapu">Pacific/Tongatapu</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Pacific/Wake" ): ?> selected <?php endif; ?> value="Pacific/Wake">Pacific/Wake</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "Pacific/Wallis" ): ?> selected <?php endif; ?> value="Pacific/Wallis">Pacific/Wallis</option>
                                    <option <?php if($pSe && $pSe->timezone ==  "UTC" ): ?> selected <?php endif; ?> value="UTC">UTC</option>
                        </select>
                </div> -->
                <div class="col-md-3 mb-4">
                    <label for="name" class="form-label">Default Currency  <span class="text-danger">*</span></label>
                    <select name="currencyid"  data-live-search="true" class="form-control select2" data-size="8" tabindex="null">
                       <?php $__currentLoopData = $Currency; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option value="<?php echo e($Currency->id); ?>"><?php echo e($Currency->prefix); ?>(<?php echo e($Currency->code); ?>)</option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                       
                    </select>
                </div>
                <div class="col-md-3 mb-4">
                    <label for="name" class="form-label">Language  <span class="text-danger">*</span></label>
                    <select name="Language" class="form-control select2" data-size="8" tabindex="null">
                       <option <?php if($pSe && $pSe->Language ==  "en" ): ?> selected <?php endif; ?> value="en">English</option>
                    </select>
                </div>
                <!-- <div class="col-md-3 mb-4">
                    <label for="name" class="form-label">Datatable Row Limit   <span class="text-danger">*</span></label>
                    <select name="datatable_row_limit" class="form-control select2" tabindex="null">
                        <option <?php if($pSe && $pSe->datatable_row_limit ==  "10" ): ?> selected <?php endif; ?> value="10">10</option>
                        <option <?php if($pSe && $pSe->datatable_row_limit ==  "25" ): ?> selected <?php endif; ?> value="25">25</option>
                        <option <?php if($pSe && $pSe->datatable_row_limit ==  "50" ): ?> selected <?php endif; ?> value="50">50</option>
                        <option <?php if($pSe && $pSe->datatable_row_limit ==  "100" ): ?> selected <?php endif; ?> value="100">100</option>
                    </select>
                </div> -->
                <!-- <div class="col-md-3 mb-4">
                    <div class="form-check form-check-primary mt-4">
                        <input class="form-check-input" name="Employeecanexportdata" <?php if($pSe && $pSe->Employeecanexportdata ==  "on" ): ?> checked <?php endif; ?> type="checkbox" id="customCheckPrimary" >
                        <label class="form-check-label" for="customCheckPrimary">Employee can export data</label>
                      </div>
                </div> -->
                <div class="col-md-12 mb-4 ">
                    <label class="form-label" for="customCheckPrimary">WellCome text (Admin)</label>
                    <div class="editor-container form-control" style="width: 97%; margin-left: 11px;">
                        <div class="full-editor geteditor"><?php if($pSe && $pSe->welcometext): ?> <?php echo $pSe->welcometext; ?> <?php endif; ?></div>
                        <input type="hidden" name="welcometext" <?php if($pSe && $pSe->welcometext): ?> value="<?php echo e($pSe->welcometext); ?>" <?php endif; ?> class="hidden-field">
                    </div>
                </div>
                <div class="col-md-12 mb-4 ">
                    <label class="form-label" for="customCheckPrimary">WellCome text (Employee)</label>
                    <div class="editor-container form-control" style="width: 97%; margin-left: 11px;" >
                        <div class="full-editor geteditor"><?php if($pSe && $pSe->welcometextEmployee): ?> <?php echo $pSe->welcometextEmployee; ?> <?php endif; ?></div>
                        <input type="hidden" name="welcometextEmployee" <?php if($pSe && $pSe->welcometextEmployee): ?> value="<?php echo e($pSe->welcometextEmployee); ?>" <?php endif; ?> class="hidden-field">
                    </div>
                </div>
                <div class="col-md-12 mb-4 ">
                    <label class="form-label" for="customCheckPrimary">WellCome text (Client)</label>
                    <div class="editor-container form-control" style="width: 97%; margin-left: 11px;" >
                        <div class="full-editor geteditor"><?php if($pSe && $pSe->welcometextClient): ?> <?php echo $pSe->welcometextClient; ?> <?php endif; ?></div>
                        <input type="hidden" name="welcometextClient" <?php if($pSe && $pSe->welcometextClient): ?> value="<?php echo e($pSe->welcometextClient); ?>" <?php endif; ?> class="hidden-field">
                    </div>
                </div>
                <div class="col-md-12 row mb-4">
                    <label class="form-label" for="customCheckPrimary">Company Logo</label>
                    <div class="col-md-6">
                        <div class="avatar-preview">
                           <img id="comapnyLogoPreview" width="100"  <?php if($pSe && $pSe->CompanyLogo): ?> src="<?php echo e($pSe->CompanyLogo); ?>" <?php endif; ?> alt="Preview" />
                        </div>
                  </div>
                  <div class="col-md-6">
                      <div class="avatar-upload">
                        <div class="avatar-edit">
                           <input type="file" class="form-control" id="comapnyLogo" onchange="readURL(this,'comapnyLogoPreview')"  name="CompanyLogo"  accept=".png, .jpg" />
                           <label for="comapnyLogo">Accepted formats: .png, .jpg</label>
                        </div>
                      </div>
                  </div>
                </div>
                <div class="col-md-12 row mb-4">
                    <label class="form-label" for="customCheckPrimary">Company Banner (Admin)</label>
                    <div class="col-md-6">
                        <div class="avatar-preview">
                           <img id="CompanyBannerPreview" width="100"  <?php if($pSe && $pSe->CompanyBanner): ?> src="<?php echo e($pSe->CompanyBanner); ?>" <?php endif; ?> alt="Preview" />
                        </div>
                  </div>
                  <div class="col-md-6">
                      <div class="avatar-upload">
                        <div class="avatar-edit">
                           <input type="file" class="form-control" onchange="readURL(this,'CompanyBannerPreview')"  name="CompanyBanner"  accept=".png, .jpg" />
                           <label for="imageUpload">Accepted formats: .png, .jpg</label>
                        </div>
                      </div>
                  </div>
                </div>
                <div class="col-md-12 row mb-4">
                    <label class="form-label" for="customCheckPrimary">Company Banner (Employee)</label>
                    <div class="col-md-6">
                        <div class="avatar-preview">
                           <img id="CompanyBannerEmployeePreview" width="100"   <?php if($pSe && $pSe->CompanyBannerEmployee): ?> src="<?php echo e($pSe->CompanyBannerEmployee); ?>" <?php endif; ?> alt="Preview" />
                        </div>
                  </div>
                  <div class="col-md-6">
                      <div class="avatar-upload">
                        <div class="avatar-edit">
                           <input type="file" class="form-control"  onchange="readURL(this,'CompanyBannerEmployeePreview')"  name="CompanyBannerEmployee"  accept=".png, .jpg" />
                           <label for="imageUpload">Accepted formats: .png, .jpg</label>
                        </div>
                      </div>
                  </div>
                </div>
                <div class="col-md-12 row mb-4">
                    <label class="form-label" for="customCheckPrimary">Company Banner (Client)</label>
                    <div class="col-md-6">
                        <div class="avatar-preview">
                           <img id="CompanyBannerClientPreview" width="100"    <?php if($pSe && $pSe->CompanyBannerClient): ?> src="<?php echo e($pSe->CompanyBannerClient); ?>" <?php endif; ?> alt="Preview" />
                        </div>
                  </div>
                  <div class="col-md-6">
                      <div class="avatar-upload">
                        <div class="avatar-edit">
                           <input type="file" class="form-control" id="imageUpload"  name="CompanyBannerClient" onchange="readURL(this,'CompanyBannerClientPreview')"  accept=".png, .jpg" />
                           <label for="imageUpload">Accepted formats: .png, .jpg</label>
                        </div>
                      </div>
                  </div>
                </div>

              </div>
            </div>
            <div class="card-footer text-center">
                  <button type="submit" class="btn btn-success">Submit</button>
            </div> 
          </form>
        </div>
      </div>
   
<script>
    // Function to read and display the selected image
    function readURL(input,id) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                // Set the 'src' attribute of the 'img' tag
                $('#'+id).attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

   
</script>
<script>
  $(document).ready(function () {
    // Function to update the hidden field based on the editor content
    function updateHiddenField(index) {
      var editorContentText = $(".full-editor.geteditor").eq(index).html();
      console.log("Editor " + (index + 1) + " Text content: " + editorContentText);

      // Update the value of the hidden field based on the index
      $('.hidden-field').eq(index).val(editorContentText);
    }

    // Use event delegation to handle keyup and blur on any .full-editor.geteditor
    $(document).on('keyup blur', '.full-editor.geteditor', function () {
      // Get the index of the editor
      var index = $(".full-editor.geteditor").index(this);

      // Update the corresponding hidden field
      updateHiddenField(index);
    });
  });
</script><?php /**PATH /home/insighthub/public_html/resources/views/admin/settings/AppSettings/home.blade.php ENDPATH**/ ?>