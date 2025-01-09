
      
          <div class="card-header sticky-element bg-label-secondary d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row p-2">
            <h5 class="card-title mb-sm-0 me-2">App Setting's</h5>
          </div>
           @if(Session::has('success'))
   <div class="alert alert-success" role="alert">{{ Session::get('success') }}</div>
    @endif
          <form action="{{url('admin/AppSettings/store')}}" method="post" enctype="multipart/form-data"> 
            @csrf
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
                            <option @if($pSe && $pSe->date_format ==  "d-m-Y" )selected @endif value="d-m-Y" selected="">d-m-Y ({{ date('d-m-Y') }})</option>
                            <option @if($pSe && $pSe->date_format ==  "m-d-Y" )selected @endif value="m-d-Y">m-d-Y ({{ date('m-d-Y') }})</option>
                            <option @if($pSe && $pSe->date_format ==  "Y-m-d" )selected @endif value="Y-m-d">Y-m-d ({{ date('Y-m-d') }})</option>
                            <option @if($pSe && $pSe->date_format ==  "d.m.Y" )selected @endif value="d.m.Y">d.m.Y ({{ date('d.m.Y') }})</option>
                            <option @if($pSe && $pSe->date_format ==  "m.d.Y" )selected @endif value="m.d.Y">m.d.Y ({{ date('m.d.Y') }})</option>
                            <option @if($pSe && $pSe->date_format ==  "Y.m.d" )selected @endif value="Y.m.d">Y.m.d ({{ date('Y.m.d') }})</option>
                            <option @if($pSe && $pSe->date_format ==  "d/m/Y" )selected @endif value="d/m/Y">d/m/Y ({{ date('d/m/Y') }})</option>
                            <option @if($pSe && $pSe->date_format ==  "m/d/Y" )selected @endif value="m/d/Y">m/d/Y ({{ date('m/d/Y') }})</option>
                            <option @if($pSe && $pSe->date_format ==  "Y/m/d" )selected @endif value="Y/m/d">Y/m/d ({{ date('Y/m/d') }})</option>
                            <option @if($pSe && $pSe->date_format ==  "d/M/Y" )selected @endif value="d/M/Y">d/M/Y ({{ date('d/M/Y') }})</option>
                            <option @if($pSe && $pSe->date_format ==  "d.M.Y" )selected @endif value="d.M.Y">d.M.Y ({{ date('d.M.Y') }})</option>
                            <option @if($pSe && $pSe->date_format ==  "d-M-Y" )selected @endif value="d-M-Y">d-M-Y ({{ date('d-M-Y') }})</option>
                            <option @if($pSe && $pSe->date_format ==  "d M Y" )selected @endif value="d M Y">d M Y ({{ date('d M Y') }})</option>
                            <option @if($pSe && $pSe->date_format ==  "d F, Y" )selected @endif value="d F, Y">d F, Y ({{ date('d F, Y') }})</option>
                            <option @if($pSe && $pSe->date_format ==  "D/M/Y" )selected @endif value="D/M/Y">D/M/Y ({{ date('D/M/Y') }})</option>
                            <option @if($pSe && $pSe->date_format ==  "D.M.Y" )selected @endif value="D.M.Y">D.M.Y ({{ date('D.M.Y') }})</option>
                            <option @if($pSe && $pSe->date_format ==  "D-M-Y" )selected @endif value="D-M-Y">D-M-Y ({{ date('D-M-Y') }})</option>
                            <option @if($pSe && $pSe->date_format ==  "D M Y" )selected @endif value="D M Y">D M Y ({{ date('D M Y') }})</option>
                            <option @if($pSe && $pSe->date_format ==  "d D M Y") selected @endif value="d D M Y">d D M Y ({{ date('d D M Y') }})</option>
                            <option @if($pSe && $pSe->date_format ==  "D d M Y")selected @endif value="D d M Y">D d M Y ({{ date('D d M Y') }})</option>
                            <option @if($pSe && $pSe->date_format ==  "dS M Y")selected @endif value="dS M Y">dS M Y ({{ date('dS M Y') }})</option>
                        </select>

                </div>
                <div class="col-md-3 mb-4">
                    <label for="name" class="form-label">Time Format <span class="text-danger">*</span></label>
                    <select name="time_format" class="form-control select2" tabindex="null">
                        <option @if($pSe && $pSe->time_format ==  "h:i a" ) selected @endif value="h:i a" >12 Hour(s) ({{ date('h:i a') }})</option>
                        <option @if($pSe && $pSe->time_format ==  "H:i" ) selected @endif value="H:i" >24 Hour(s) ({{ date('H:i') }})</option>
                    </select>
                </div>
                <div class="col-md-3 mb-4">
                    <label for="name" class="form-label">Default Timezone <span class="text-danger">*</span></label>
                    <select name="timezone" id="timezone" data-live-search="true" class="form-control select2" tabindex="null">
                                    <option @if($pSe && $pSe->timezone ==  "Africa/Abidjan" ) selected @endif value="Africa/Abidjan">Africa/Abidjan</option>
                                    <option @if($pSe && $pSe->timezone ==  "Africa/Accra" ) selected @endif value="Africa/Accra">Africa/Accra</option>
                                    <option @if($pSe && $pSe->timezone ==  "Africa/Addis_Ababa" ) selected @endif value="Africa/Addis_Ababa">Africa/Addis_Ababa</option>
                                    <option @if($pSe && $pSe->timezone ==  "Africa/Algiers" ) selected @endif value="Africa/Algiers">Africa/Algiers</option>
                                    <option @if($pSe && $pSe->timezone ==  "Africa/Asmara" ) selected @endif value="Africa/Asmara">Africa/Asmara</option>
                                    <option @if($pSe && $pSe->timezone ==  "Africa/Bamako" ) selected @endif value="Africa/Bamako">Africa/Bamako</option>
                                    <option @if($pSe && $pSe->timezone ==  "Africa/Bangui" ) selected @endif value="Africa/Bangui">Africa/Bangui</option>
                                    <option @if($pSe && $pSe->timezone ==  "Africa/Banjul" ) selected @endif value="Africa/Banjul">Africa/Banjul</option>
                                    <option @if($pSe && $pSe->timezone ==  "Africa/Bissau" ) selected @endif value="Africa/Bissau">Africa/Bissau</option>
                                    <option @if($pSe && $pSe->timezone ==  "Africa/Blantyre" ) selected @endif value="Africa/Blantyre">Africa/Blantyre</option>
                                    <option @if($pSe && $pSe->timezone ==  "Africa/Brazzaville" ) selected @endif value="Africa/Brazzaville">Africa/Brazzaville</option>
                                    <option @if($pSe && $pSe->timezone ==  "Africa/Bujumbura" ) selected @endif value="Africa/Bujumbura">Africa/Bujumbura</option>
                                    <option @if($pSe && $pSe->timezone ==  "Africa/Cairo" ) selected @endif value="Africa/Cairo">Africa/Cairo</option>
                                    <option @if($pSe && $pSe->timezone ==  "Africa/Casablanca" ) selected @endif value="Africa/Casablanca">Africa/Casablanca</option>
                                    <option @if($pSe && $pSe->timezone ==  "Africa/Ceuta" ) selected @endif value="Africa/Ceuta">Africa/Ceuta</option>
                                    <option @if($pSe && $pSe->timezone ==  "Africa/Conakry" ) selected @endif value="Africa/Conakry">Africa/Conakry</option>
                                    <option @if($pSe && $pSe->timezone ==  "Africa/Dakar" ) selected @endif value="Africa/Dakar">Africa/Dakar</option>
                                    <option @if($pSe && $pSe->timezone ==  "Africa/Dar_es_Salaam" ) selected @endif value="Africa/Dar_es_Salaam">Africa/Dar_es_Salaam</option>
                                    <option @if($pSe && $pSe->timezone ==  "Africa/Djibouti" ) selected @endif value="Africa/Djibouti">Africa/Djibouti</option>
                                    <option @if($pSe && $pSe->timezone ==  "Africa/Douala" ) selected @endif value="Africa/Douala">Africa/Douala</option>
                                    <option @if($pSe && $pSe->timezone ==  "Africa/El_Aaiun" ) selected @endif value="Africa/El_Aaiun">Africa/El_Aaiun</option>
                                    <option @if($pSe && $pSe->timezone ==  "Africa/Freetown" ) selected @endif value="Africa/Freetown">Africa/Freetown</option>
                                    <option @if($pSe && $pSe->timezone ==  "Africa/Gaborone" ) selected @endif value="Africa/Gaborone">Africa/Gaborone</option>
                                    <option @if($pSe && $pSe->timezone ==  "Africa/Harare" ) selected @endif value="Africa/Harare">Africa/Harare</option>
                                    <option @if($pSe && $pSe->timezone ==  "Africa/Johannesburg" ) selected @endif value="Africa/Johannesburg">Africa/Johannesburg</option>
                                    <option @if($pSe && $pSe->timezone ==  "Africa/Juba" ) selected @endif value="Africa/Juba">Africa/Juba</option>
                                    <option @if($pSe && $pSe->timezone ==  "Africa/Kampala" ) selected @endif value="Africa/Kampala">Africa/Kampala</option>
                                    <option @if($pSe && $pSe->timezone ==  "Africa/Khartoum" ) selected @endif value="Africa/Khartoum">Africa/Khartoum</option>
                                    <option @if($pSe && $pSe->timezone ==  "Africa/Kigali" ) selected @endif value="Africa/Kigali">Africa/Kigali</option>
                                    <option @if($pSe && $pSe->timezone ==  "Africa/Kinshasa" ) selected @endif value="Africa/Kinshasa">Africa/Kinshasa</option>
                                    <option @if($pSe && $pSe->timezone ==  "Africa/Lagos" ) selected @endif value="Africa/Lagos">Africa/Lagos</option>
                                    <option @if($pSe && $pSe->timezone ==  "Africa/Libreville" ) selected @endif value="Africa/Libreville">Africa/Libreville</option>
                                    <option @if($pSe && $pSe->timezone ==  "Africa/Lome" ) selected @endif value="Africa/Lome">Africa/Lome</option>
                                    <option @if($pSe && $pSe->timezone ==  "Africa/Luanda" ) selected @endif value="Africa/Luanda">Africa/Luanda</option>
                                    <option @if($pSe && $pSe->timezone ==  "Africa/Lubumbashi" ) selected @endif value="Africa/Lubumbashi">Africa/Lubumbashi</option>
                                    <option @if($pSe && $pSe->timezone ==  "Africa/Lusaka" ) selected @endif value="Africa/Lusaka">Africa/Lusaka</option>
                                    <option @if($pSe && $pSe->timezone ==  "Africa/Malabo" ) selected @endif value="Africa/Malabo">Africa/Malabo</option>
                                    <option @if($pSe && $pSe->timezone ==  "Africa/Maputo" ) selected @endif value="Africa/Maputo">Africa/Maputo</option>
                                    <option @if($pSe && $pSe->timezone ==  "Africa/Maseru" ) selected @endif value="Africa/Maseru">Africa/Maseru</option>
                                    <option @if($pSe && $pSe->timezone ==  "Africa/Mbabane" ) selected @endif value="Africa/Mbabane">Africa/Mbabane</option>
                                    <option @if($pSe && $pSe->timezone ==  "Africa/Mogadishu" ) selected @endif value="Africa/Mogadishu">Africa/Mogadishu</option>
                                    <option @if($pSe && $pSe->timezone ==  "Africa/Monrovia" ) selected @endif value="Africa/Monrovia">Africa/Monrovia</option>
                                    <option @if($pSe && $pSe->timezone ==  "Africa/Nairobi" ) selected @endif value="Africa/Nairobi">Africa/Nairobi</option>
                                    <option @if($pSe && $pSe->timezone ==  "Africa/Ndjamena" ) selected @endif value="Africa/Ndjamena">Africa/Ndjamena</option>
                                    <option @if($pSe && $pSe->timezone ==  "Africa/Niamey" ) selected @endif value="Africa/Niamey">Africa/Niamey</option>
                                    <option @if($pSe && $pSe->timezone ==  "Africa/Nouakchott" ) selected @endif value="Africa/Nouakchott">Africa/Nouakchott</option>
                                    <option @if($pSe && $pSe->timezone ==  "Africa/Ouagadougou" ) selected @endif value="Africa/Ouagadougou">Africa/Ouagadougou</option>
                                    <option @if($pSe && $pSe->timezone ==  "Africa/Porto" ) selected @endif value="Africa/Porto-Novo">Africa/Porto-Novo</option>
                                    <option @if($pSe && $pSe->timezone ==  "Africa/Sao_Tome" ) selected @endif value="Africa/Sao_Tome">Africa/Sao_Tome</option>
                                    <option @if($pSe && $pSe->timezone ==  "Africa/Tripoli" ) selected @endif value="Africa/Tripoli">Africa/Tripoli</option>
                                    <option @if($pSe && $pSe->timezone ==  "Africa/Tunis" ) selected @endif value="Africa/Tunis">Africa/Tunis</option>
                                    <option @if($pSe && $pSe->timezone ==  "Africa/Windhoek" ) selected @endif value="Africa/Windhoek">Africa/Windhoek</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Adak" ) selected @endif value="America/Adak">America/Adak</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Anchorage" ) selected @endif value="America/Anchorage">America/Anchorage</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Anguilla" ) selected @endif value="America/Anguilla">America/Anguilla</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Antigua" ) selected @endif value="America/Antigua">America/Antigua</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Araguaina" ) selected @endif value="America/Araguaina">America/Araguaina</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Argentina" ) selected @endif value="America/Argentina/Buenos_Aires">America/Argentina/Buenos_Aires</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Argentina" ) selected @endif value="America/Argentina/Catamarca">America/Argentina/Catamarca</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Argentina" ) selected @endif value="America/Argentina/Cordoba">America/Argentina/Cordoba</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Argentina" ) selected @endif value="America/Argentina/Jujuy">America/Argentina/Jujuy</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Argentina" ) selected @endif value="America/Argentina/La_Rioja">America/Argentina/La_Rioja</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Argentina" ) selected @endif value="America/Argentina/Mendoza">America/Argentina/Mendoza</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Argentina" ) selected @endif value="America/Argentina/Rio_Gallegos">America/Argentina/Rio_Gallegos</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Argentina" ) selected @endif value="America/Argentina/Salta">America/Argentina/Salta</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Argentina" ) selected @endif value="America/Argentina/San_Juan">America/Argentina/San_Juan</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Argentina" ) selected @endif value="America/Argentina/San_Luis">America/Argentina/San_Luis</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Argentina" ) selected @endif value="America/Argentina/Tucuman">America/Argentina/Tucuman</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Argentina" ) selected @endif value="America/Argentina/Ushuaia">America/Argentina/Ushuaia</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Aruba" ) selected @endif value="America/Aruba">America/Aruba</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Asuncion" ) selected @endif value="America/Asuncion">America/Asuncion</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Atikokan" ) selected @endif value="America/Atikokan">America/Atikokan</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Bahia" ) selected @endif value="America/Bahia">America/Bahia</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Bahia_Banderas" ) selected @endif value="America/Bahia_Banderas">America/Bahia_Banderas</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Barbados" ) selected @endif value="America/Barbados">America/Barbados</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Belem" ) selected @endif value="America/Belem">America/Belem</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Belize" ) selected @endif value="America/Belize">America/Belize</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Blanc" ) selected @endif value="America/Blanc-Sablon">America/Blanc-Sablon</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Boa_Vista" ) selected @endif value="America/Boa_Vista">America/Boa_Vista</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Bogota" ) selected @endif value="America/Bogota">America/Bogota</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Boise" ) selected @endif value="America/Boise">America/Boise</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Cambridge_Bay" ) selected @endif value="America/Cambridge_Bay">America/Cambridge_Bay</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Campo_Grande" ) selected @endif value="America/Campo_Grande">America/Campo_Grande</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Cancun" ) selected @endif value="America/Cancun">America/Cancun</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Caracas" ) selected @endif value="America/Caracas">America/Caracas</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Cayenne" ) selected @endif value="America/Cayenne">America/Cayenne</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Cayman" ) selected @endif value="America/Cayman">America/Cayman</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Chicago" ) selected @endif value="America/Chicago">America/Chicago</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Chihuahua" ) selected @endif value="America/Chihuahua">America/Chihuahua</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Ciudad_Juarez" ) selected @endif value="America/Ciudad_Juarez">America/Ciudad_Juarez</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Costa_Rica" ) selected @endif value="America/Costa_Rica">America/Costa_Rica</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Creston" ) selected @endif value="America/Creston">America/Creston</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Cuiaba" ) selected @endif value="America/Cuiaba">America/Cuiaba</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Curacao" ) selected @endif value="America/Curacao">America/Curacao</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Danmarkshavn" ) selected @endif value="America/Danmarkshavn">America/Danmarkshavn</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Dawson" ) selected @endif value="America/Dawson">America/Dawson</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Dawson_Creek" ) selected @endif value="America/Dawson_Creek">America/Dawson_Creek</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Denver" ) selected @endif value="America/Denver">America/Denver</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Detroit" ) selected @endif value="America/Detroit">America/Detroit</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Dominica" ) selected @endif value="America/Dominica">America/Dominica</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Edmonton" ) selected @endif value="America/Edmonton">America/Edmonton</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Eirunepe" ) selected @endif value="America/Eirunepe">America/Eirunepe</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/El_Salvador" ) selected @endif value="America/El_Salvador">America/El_Salvador</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Fort_Nelson" ) selected @endif value="America/Fort_Nelson">America/Fort_Nelson</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Fortaleza" ) selected @endif value="America/Fortaleza">America/Fortaleza</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Glace_Bay" ) selected @endif value="America/Glace_Bay">America/Glace_Bay</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Goose_Bay" ) selected @endif value="America/Goose_Bay">America/Goose_Bay</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Grand_Turk" ) selected @endif value="America/Grand_Turk">America/Grand_Turk</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Grenada" ) selected @endif value="America/Grenada">America/Grenada</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Guadeloupe" ) selected @endif value="America/Guadeloupe">America/Guadeloupe</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Guatemala" ) selected @endif value="America/Guatemala">America/Guatemala</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Guayaquil" ) selected @endif value="America/Guayaquil">America/Guayaquil</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Guyana" ) selected @endif value="America/Guyana">America/Guyana</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Halifax" ) selected @endif value="America/Halifax">America/Halifax</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Havana" ) selected @endif value="America/Havana">America/Havana</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Hermosillo" ) selected @endif value="America/Hermosillo">America/Hermosillo</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Indiana" ) selected @endif value="America/Indiana/Indianapolis">America/Indiana/Indianapolis</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Indiana" ) selected @endif value="America/Indiana/Knox">America/Indiana/Knox</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Indiana" ) selected @endif value="America/Indiana/Marengo">America/Indiana/Marengo</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Indiana" ) selected @endif value="America/Indiana/Petersburg">America/Indiana/Petersburg</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Indiana" ) selected @endif value="America/Indiana/Tell_City">America/Indiana/Tell_City</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Indiana" ) selected @endif value="America/Indiana/Vevay">America/Indiana/Vevay</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Indiana" ) selected @endif value="America/Indiana/Vincennes">America/Indiana/Vincennes</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Indiana" ) selected @endif value="America/Indiana/Winamac">America/Indiana/Winamac</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Inuvik" ) selected @endif value="America/Inuvik">America/Inuvik</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Iqaluit" ) selected @endif value="America/Iqaluit">America/Iqaluit</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Jamaica" ) selected @endif value="America/Jamaica">America/Jamaica</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Juneau" ) selected @endif value="America/Juneau">America/Juneau</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Kentucky" ) selected @endif value="America/Kentucky/Louisville">America/Kentucky/Louisville</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Kentucky" ) selected @endif value="America/Kentucky/Monticello">America/Kentucky/Monticello</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Kralendijk" ) selected @endif value="America/Kralendijk">America/Kralendijk</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/La_Paz" ) selected @endif value="America/La_Paz">America/La_Paz</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Lima" ) selected @endif value="America/Lima">America/Lima</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Los_Angeles" ) selected @endif value="America/Los_Angeles">America/Los_Angeles</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Lower_Princes" ) selected @endif value="America/Lower_Princes">America/Lower_Princes</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Maceio" ) selected @endif value="America/Maceio">America/Maceio</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Managua" ) selected @endif value="America/Managua">America/Managua</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Manaus" ) selected @endif value="America/Manaus">America/Manaus</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Marigot" ) selected @endif value="America/Marigot">America/Marigot</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Martinique" ) selected @endif value="America/Martinique">America/Martinique</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Matamoros" ) selected @endif value="America/Matamoros">America/Matamoros</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Mazatlan" ) selected @endif value="America/Mazatlan">America/Mazatlan</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Menominee" ) selected @endif value="America/Menominee">America/Menominee</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Merida" ) selected @endif value="America/Merida">America/Merida</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Metlakatla" ) selected @endif value="America/Metlakatla">America/Metlakatla</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Mexico_City" ) selected @endif value="America/Mexico_City">America/Mexico_City</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Miquelon" ) selected @endif value="America/Miquelon">America/Miquelon</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Moncton" ) selected @endif value="America/Moncton">America/Moncton</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Monterrey" ) selected @endif value="America/Monterrey">America/Monterrey</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Montevideo" ) selected @endif value="America/Montevideo">America/Montevideo</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Montserrat" ) selected @endif value="America/Montserrat">America/Montserrat</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Nassau" ) selected @endif value="America/Nassau">America/Nassau</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/New_York" ) selected @endif value="America/New_York">America/New_York</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Nome" ) selected @endif value="America/Nome">America/Nome</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Noronha" ) selected @endif value="America/Noronha">America/Noronha</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/North_Dakota" ) selected @endif value="America/North_Dakota/Beulah">America/North_Dakota/Beulah</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/North_Dakota" ) selected @endif value="America/North_Dakota/Center">America/North_Dakota/Center</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/North_Dakota" ) selected @endif value="America/North_Dakota/New_Salem">America/North_Dakota/New_Salem</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Nuuk" ) selected @endif value="America/Nuuk">America/Nuuk</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Ojinaga" ) selected @endif value="America/Ojinaga">America/Ojinaga</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Panama" ) selected @endif value="America/Panama">America/Panama</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Paramaribo" ) selected @endif value="America/Paramaribo">America/Paramaribo</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Phoenix" ) selected @endif value="America/Phoenix">America/Phoenix</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Port" ) selected @endif value="America/Port-au-Prince">America/Port-au-Prince</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Port_of_Spain" ) selected @endif value="America/Port_of_Spain">America/Port_of_Spain</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Porto_Velho" ) selected @endif value="America/Porto_Velho">America/Porto_Velho</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Puerto_Rico" ) selected @endif value="America/Puerto_Rico">America/Puerto_Rico</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Punta_Arenas" ) selected @endif value="America/Punta_Arenas">America/Punta_Arenas</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Rankin_Inlet" ) selected @endif value="America/Rankin_Inlet">America/Rankin_Inlet</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Recife" ) selected @endif value="America/Recife">America/Recife</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Regina" ) selected @endif value="America/Regina">America/Regina</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Resolute" ) selected @endif value="America/Resolute">America/Resolute</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Rio_Branco" ) selected @endif value="America/Rio_Branco">America/Rio_Branco</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Santarem" ) selected @endif value="America/Santarem">America/Santarem</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Santiago" ) selected @endif value="America/Santiago">America/Santiago</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Santo_Domingo" ) selected @endif value="America/Santo_Domingo">America/Santo_Domingo</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Sao_Paulo" ) selected @endif value="America/Sao_Paulo">America/Sao_Paulo</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Scoresbysund" ) selected @endif value="America/Scoresbysund">America/Scoresbysund</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Sitka" ) selected @endif value="America/Sitka">America/Sitka</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/St_Barthelemy" ) selected @endif value="America/St_Barthelemy">America/St_Barthelemy</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/St_Johns" ) selected @endif value="America/St_Johns">America/St_Johns</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/St_Kitts" ) selected @endif value="America/St_Kitts">America/St_Kitts</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/St_Lucia" ) selected @endif value="America/St_Lucia">America/St_Lucia</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/St_Thomas" ) selected @endif value="America/St_Thomas">America/St_Thomas</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/St_Vincent" ) selected @endif value="America/St_Vincent">America/St_Vincent</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Swift_Current" ) selected @endif value="America/Swift_Current">America/Swift_Current</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Tegucigalpa" ) selected @endif value="America/Tegucigalpa">America/Tegucigalpa</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Thule" ) selected @endif value="America/Thule">America/Thule</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Tijuana" ) selected @endif value="America/Tijuana">America/Tijuana</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Toronto" ) selected @endif value="America/Toronto">America/Toronto</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Tortola" ) selected @endif value="America/Tortola">America/Tortola</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Vancouver" ) selected @endif value="America/Vancouver">America/Vancouver</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Whitehorse" ) selected @endif value="America/Whitehorse">America/Whitehorse</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Winnipeg" ) selected @endif value="America/Winnipeg">America/Winnipeg</option>
                                    <option @if($pSe && $pSe->timezone ==  "America/Yakutat" ) selected @endif value="America/Yakutat">America/Yakutat</option>
                                    <option @if($pSe && $pSe->timezone ==  "Antarctica/Casey" ) selected @endif value="Antarctica/Casey">Antarctica/Casey</option>
                                    <option @if($pSe && $pSe->timezone ==  "Antarctica/Davis" ) selected @endif value="Antarctica/Davis">Antarctica/Davis</option>
                                    <option @if($pSe && $pSe->timezone ==  "Antarctica/DumontDUrville" ) selected @endif value="Antarctica/DumontDUrville">Antarctica/DumontDUrville</option>
                                    <option @if($pSe && $pSe->timezone ==  "Antarctica/Macquarie" ) selected @endif value="Antarctica/Macquarie">Antarctica/Macquarie</option>
                                    <option @if($pSe && $pSe->timezone ==  "Antarctica/Mawson" ) selected @endif value="Antarctica/Mawson">Antarctica/Mawson</option>
                                    <option @if($pSe && $pSe->timezone ==  "Antarctica/McMurdo" ) selected @endif value="Antarctica/McMurdo">Antarctica/McMurdo</option>
                                    <option @if($pSe && $pSe->timezone ==  "Antarctica/Palmer" ) selected @endif value="Antarctica/Palmer">Antarctica/Palmer</option>
                                    <option @if($pSe && $pSe->timezone ==  "Antarctica/Rothera" ) selected @endif value="Antarctica/Rothera">Antarctica/Rothera</option>
                                    <option @if($pSe && $pSe->timezone ==  "Antarctica/Syowa" ) selected @endif value="Antarctica/Syowa">Antarctica/Syowa</option>
                                    <option @if($pSe && $pSe->timezone ==  "Antarctica/Troll" ) selected @endif value="Antarctica/Troll">Antarctica/Troll</option>
                                    <option @if($pSe && $pSe->timezone ==  "Antarctica/Vostok" ) selected @endif value="Antarctica/Vostok">Antarctica/Vostok</option>
                                    <option @if($pSe && $pSe->timezone ==  "Arctic/Longyearbyen" ) selected @endif value="Arctic/Longyearbyen">Arctic/Longyearbyen</option>
                                    <option @if($pSe && $pSe->timezone ==  "Asia/Aden" ) selected @endif value="Asia/Aden">Asia/Aden</option>
                                    <option @if($pSe && $pSe->timezone ==  "Asia/Almaty" ) selected @endif value="Asia/Almaty">Asia/Almaty</option>
                                    <option @if($pSe && $pSe->timezone ==  "Asia/Amman" ) selected @endif value="Asia/Amman">Asia/Amman</option>
                                    <option @if($pSe && $pSe->timezone ==  "Asia/Anadyr" ) selected @endif value="Asia/Anadyr">Asia/Anadyr</option>
                                    <option @if($pSe && $pSe->timezone ==  "Asia/Aqtau" ) selected @endif value="Asia/Aqtau">Asia/Aqtau</option>
                                    <option @if($pSe && $pSe->timezone ==  "Asia/Aqtobe" ) selected @endif value="Asia/Aqtobe">Asia/Aqtobe</option>
                                    <option @if($pSe && $pSe->timezone ==  "Asia/Ashgabat" ) selected @endif value="Asia/Ashgabat">Asia/Ashgabat</option>
                                    <option @if($pSe && $pSe->timezone ==  "Asia/Atyrau" ) selected @endif value="Asia/Atyrau">Asia/Atyrau</option>
                                    <option @if($pSe && $pSe->timezone ==  "Asia/Baghdad" ) selected @endif value="Asia/Baghdad">Asia/Baghdad</option>
                                    <option @if($pSe && $pSe->timezone ==  "Asia/Bahrain" ) selected @endif value="Asia/Bahrain">Asia/Bahrain</option>
                                    <option @if($pSe && $pSe->timezone ==  "Asia/Baku" ) selected @endif value="Asia/Baku">Asia/Baku</option>
                                    <option @if($pSe && $pSe->timezone ==  "Asia/Bangkok" ) selected @endif value="Asia/Bangkok">Asia/Bangkok</option>
                                    <option @if($pSe && $pSe->timezone ==  "Asia/Barnaul" ) selected @endif value="Asia/Barnaul">Asia/Barnaul</option>
                                    <option @if($pSe && $pSe->timezone ==  "Asia/Beirut" ) selected @endif value="Asia/Beirut">Asia/Beirut</option>
                                    <option @if($pSe && $pSe->timezone ==  "Asia/Bishkek" ) selected @endif value="Asia/Bishkek">Asia/Bishkek</option>
                                    <option @if($pSe && $pSe->timezone ==  "Asia/Brunei" ) selected @endif value="Asia/Brunei">Asia/Brunei</option>
                                    <option @if($pSe && $pSe->timezone ==  "Asia/Chita" ) selected @endif value="Asia/Chita">Asia/Chita</option>
                                    <option @if($pSe && $pSe->timezone ==  "Asia/Choibalsan" ) selected @endif value="Asia/Choibalsan">Asia/Choibalsan</option>
                                    <option @if($pSe && $pSe->timezone ==  "Asia/Colombo" ) selected @endif value="Asia/Colombo">Asia/Colombo</option>
                                    <option @if($pSe && $pSe->timezone ==  "Asia/Damascus" ) selected @endif value="Asia/Damascus">Asia/Damascus</option>
                                    <option @if($pSe && $pSe->timezone ==  "Asia/Dhaka" ) selected @endif value="Asia/Dhaka">Asia/Dhaka</option>
                                    <option @if($pSe && $pSe->timezone ==  "Asia/Dili" ) selected @endif value="Asia/Dili">Asia/Dili</option>
                                    <option @if($pSe && $pSe->timezone ==  "Asia/Dubai" ) selected @endif value="Asia/Dubai">Asia/Dubai</option>
                                    <option @if($pSe && $pSe->timezone ==  "Asia/Dushanbe" ) selected @endif value="Asia/Dushanbe">Asia/Dushanbe</option>
                                    <option @if($pSe && $pSe->timezone ==  "Asia/Famagusta" ) selected @endif value="Asia/Famagusta">Asia/Famagusta</option>
                                    <option @if($pSe && $pSe->timezone ==  "Asia/Gaza" ) selected @endif value="Asia/Gaza">Asia/Gaza</option>
                                    <option @if($pSe && $pSe->timezone ==  "Asia/Hebron" ) selected @endif value="Asia/Hebron">Asia/Hebron</option>
                                    <option @if($pSe && $pSe->timezone ==  "Asia/Ho_Chi_Minh" ) selected @endif value="Asia/Ho_Chi_Minh">Asia/Ho_Chi_Minh</option>
                                    <option @if($pSe && $pSe->timezone ==  "Asia/Hong_Kong" ) selected @endif value="Asia/Hong_Kong">Asia/Hong_Kong</option>
                                    <option @if($pSe && $pSe->timezone ==  "Asia/Hovd" ) selected @endif value="Asia/Hovd">Asia/Hovd</option>
                                    <option @if($pSe && $pSe->timezone ==  "Asia/Irkutsk" ) selected @endif value="Asia/Irkutsk">Asia/Irkutsk</option>
                                    <option @if($pSe && $pSe->timezone ==  "Asia/Jakarta" ) selected @endif value="Asia/Jakarta">Asia/Jakarta</option>
                                    <option @if($pSe && $pSe->timezone ==  "Asia/Jayapura" ) selected @endif value="Asia/Jayapura">Asia/Jayapura</option>
                                    <option @if($pSe && $pSe->timezone ==  "Asia/Jerusalem" ) selected @endif value="Asia/Jerusalem">Asia/Jerusalem</option>
                                    <option @if($pSe && $pSe->timezone ==  "Asia/Kabul" ) selected @endif value="Asia/Kabul">Asia/Kabul</option>
                                    <option @if($pSe && $pSe->timezone ==  "Asia/Kamchatka" ) selected @endif value="Asia/Kamchatka">Asia/Kamchatka</option>
                                    <option @if($pSe && $pSe->timezone ==  "Asia/Karachi" ) selected @endif value="Asia/Karachi">Asia/Karachi</option>
                                    <option @if($pSe && $pSe->timezone ==  "Asia/Kathmandu" ) selected @endif value="Asia/Kathmandu">Asia/Kathmandu</option>
                                    <option @if($pSe && $pSe->timezone ==  "Asia/Khandyga" ) selected @endif value="Asia/Khandyga">Asia/Khandyga</option>
                                    <option @if($pSe && $pSe->timezone ==  "Asia/Kolkata" ) selected @endif value="Asia/Kolkata">Asia/Kolkata</option>
                                    <option @if($pSe && $pSe->timezone ==  "Asia/Krasnoyarsk" ) selected @endif value="Asia/Krasnoyarsk">Asia/Krasnoyarsk</option>
                                    <option @if($pSe && $pSe->timezone ==  "Asia/Kuala_Lumpur" ) selected @endif value="Asia/Kuala_Lumpur">Asia/Kuala_Lumpur</option>
                                    <option @if($pSe && $pSe->timezone ==  "Asia/Kuching" ) selected @endif value="Asia/Kuching">Asia/Kuching</option>
                                    <option @if($pSe && $pSe->timezone ==  "Asia/Kuwait" ) selected @endif value="Asia/Kuwait">Asia/Kuwait</option>
                                    <option @if($pSe && $pSe->timezone ==  "Asia/Macau" ) selected @endif value="Asia/Macau">Asia/Macau</option>
                                    <option @if($pSe && $pSe->timezone ==  "Asia/Magadan" ) selected @endif value="Asia/Magadan">Asia/Magadan</option>
                                    <option @if($pSe && $pSe->timezone ==  "Asia/Makassar" ) selected @endif value="Asia/Makassar">Asia/Makassar</option>
                                    <option @if($pSe && $pSe->timezone ==  "Asia/Manila" ) selected @endif value="Asia/Manila">Asia/Manila</option>
                                    <option @if($pSe && $pSe->timezone ==  "Asia/Muscat" ) selected @endif value="Asia/Muscat">Asia/Muscat</option>
                                    <option @if($pSe && $pSe->timezone ==  "Asia/Nicosia" ) selected @endif value="Asia/Nicosia">Asia/Nicosia</option>
                                    <option @if($pSe && $pSe->timezone ==  "Asia/Novokuznetsk" ) selected @endif value="Asia/Novokuznetsk">Asia/Novokuznetsk</option>
                                    <option @if($pSe && $pSe->timezone ==  "Asia/Novosibirsk" ) selected @endif value="Asia/Novosibirsk">Asia/Novosibirsk</option>
                                    <option @if($pSe && $pSe->timezone ==  "Asia/Omsk" ) selected @endif value="Asia/Omsk">Asia/Omsk</option>
                                    <option @if($pSe && $pSe->timezone ==  "Asia/Oral" ) selected @endif value="Asia/Oral">Asia/Oral</option>
                                    <option @if($pSe && $pSe->timezone ==  "Asia/Phnom_Penh" ) selected @endif value="Asia/Phnom_Penh">Asia/Phnom_Penh</option>
                                    <option @if($pSe && $pSe->timezone ==  "Asia/Pontianak" ) selected @endif value="Asia/Pontianak">Asia/Pontianak</option>
                                    <option @if($pSe && $pSe->timezone ==  "Asia/Pyongyang" ) selected @endif value="Asia/Pyongyang">Asia/Pyongyang</option>
                                    <option @if($pSe && $pSe->timezone ==  "Asia/Qatar" ) selected @endif value="Asia/Qatar">Asia/Qatar</option>
                                    <option @if($pSe && $pSe->timezone ==  "Asia/Qostanay" ) selected @endif value="Asia/Qostanay">Asia/Qostanay</option>
                                    <option @if($pSe && $pSe->timezone ==  "Asia/Qyzylorda" ) selected @endif value="Asia/Qyzylorda">Asia/Qyzylorda</option>
                                    <option @if($pSe && $pSe->timezone ==  "Asia/Riyadh" ) selected @endif value="Asia/Riyadh">Asia/Riyadh</option>
                                    <option @if($pSe && $pSe->timezone ==  "Asia/Sakhalin" ) selected @endif value="Asia/Sakhalin">Asia/Sakhalin</option>
                                    <option @if($pSe && $pSe->timezone ==  "Asia/Samarkand" ) selected @endif value="Asia/Samarkand">Asia/Samarkand</option>
                                    <option @if($pSe && $pSe->timezone ==  "Asia/Seoul" ) selected @endif value="Asia/Seoul">Asia/Seoul</option>
                                    <option @if($pSe && $pSe->timezone ==  "Asia/Shanghai" ) selected @endif value="Asia/Shanghai">Asia/Shanghai</option>
                                    <option @if($pSe && $pSe->timezone ==  "Asia/Singapore" ) selected @endif value="Asia/Singapore">Asia/Singapore</option>
                                    <option @if($pSe && $pSe->timezone ==  "Asia/Srednekolymsk" ) selected @endif value="Asia/Srednekolymsk">Asia/Srednekolymsk</option>
                                    <option @if($pSe && $pSe->timezone ==  "Asia/Taipei" ) selected @endif value="Asia/Taipei">Asia/Taipei</option>
                                    <option @if($pSe && $pSe->timezone ==  "Asia/Tashkent" ) selected @endif value="Asia/Tashkent">Asia/Tashkent</option>
                                    <option @if($pSe && $pSe->timezone ==  "Asia/Tbilisi" ) selected @endif value="Asia/Tbilisi">Asia/Tbilisi</option>
                                    <option @if($pSe && $pSe->timezone ==  "Asia/Tehran" ) selected @endif value="Asia/Tehran">Asia/Tehran</option>
                                    <option @if($pSe && $pSe->timezone ==  "Asia/Thimphu" ) selected @endif value="Asia/Thimphu">Asia/Thimphu</option>
                                    <option @if($pSe && $pSe->timezone ==  "Asia/Tokyo" ) selected @endif value="Asia/Tokyo">Asia/Tokyo</option>
                                    <option @if($pSe && $pSe->timezone ==  "Asia/Tomsk" ) selected @endif value="Asia/Tomsk">Asia/Tomsk</option>
                                    <option @if($pSe && $pSe->timezone ==  "Asia/Ulaanbaatar" ) selected @endif value="Asia/Ulaanbaatar">Asia/Ulaanbaatar</option>
                                    <option @if($pSe && $pSe->timezone ==  "Asia/Urumqi" ) selected @endif value="Asia/Urumqi">Asia/Urumqi</option>
                                    <option @if($pSe && $pSe->timezone ==  "Asia/Ust" ) selected @endif value="Asia/Ust-Nera">Asia/Ust-Nera</option>
                                    <option @if($pSe && $pSe->timezone ==  "Asia/Vientiane" ) selected @endif value="Asia/Vientiane">Asia/Vientiane</option>
                                    <option @if($pSe && $pSe->timezone ==  "Asia/Vladivostok" ) selected @endif value="Asia/Vladivostok">Asia/Vladivostok</option>
                                    <option @if($pSe && $pSe->timezone ==  "Asia/Yakutsk" ) selected @endif value="Asia/Yakutsk">Asia/Yakutsk</option>
                                    <option @if($pSe && $pSe->timezone ==  "Asia/Yangon" ) selected @endif value="Asia/Yangon">Asia/Yangon</option>
                                    <option @if($pSe && $pSe->timezone ==  "Asia/Yekaterinburg" ) selected @endif value="Asia/Yekaterinburg">Asia/Yekaterinburg</option>
                                    <option @if($pSe && $pSe->timezone ==  "Asia/Yerevan" ) selected @endif value="Asia/Yerevan">Asia/Yerevan</option>
                                    <option @if($pSe && $pSe->timezone ==  "Atlantic/Azores" ) selected @endif value="Atlantic/Azores">Atlantic/Azores</option>
                                    <option @if($pSe && $pSe->timezone ==  "Atlantic/Bermuda" ) selected @endif value="Atlantic/Bermuda">Atlantic/Bermuda</option>
                                    <option @if($pSe && $pSe->timezone ==  "Atlantic/Canary" ) selected @endif value="Atlantic/Canary">Atlantic/Canary</option>
                                    <option @if($pSe && $pSe->timezone ==  "Atlantic/Cape_Verde" ) selected @endif value="Atlantic/Cape_Verde">Atlantic/Cape_Verde</option>
                                    <option @if($pSe && $pSe->timezone ==  "Atlantic/Faroe" ) selected @endif value="Atlantic/Faroe">Atlantic/Faroe</option>
                                    <option @if($pSe && $pSe->timezone ==  "Atlantic/Madeira" ) selected @endif value="Atlantic/Madeira">Atlantic/Madeira</option>
                                    <option @if($pSe && $pSe->timezone ==  "Atlantic/Reykjavik" ) selected @endif value="Atlantic/Reykjavik">Atlantic/Reykjavik</option>
                                    <option @if($pSe && $pSe->timezone ==  "Atlantic/South_Georgia" ) selected @endif value="Atlantic/South_Georgia">Atlantic/South_Georgia</option>
                                    <option @if($pSe && $pSe->timezone ==  "Atlantic/St_Helena" ) selected @endif value="Atlantic/St_Helena">Atlantic/St_Helena</option>
                                    <option @if($pSe && $pSe->timezone ==  "Atlantic/Stanley" ) selected @endif value="Atlantic/Stanley">Atlantic/Stanley</option>
                                    <option @if($pSe && $pSe->timezone ==  "Australia/Adelaide" ) selected @endif value="Australia/Adelaide">Australia/Adelaide</option>
                                    <option @if($pSe && $pSe->timezone ==  "Australia/Brisbane" ) selected @endif value="Australia/Brisbane">Australia/Brisbane</option>
                                    <option @if($pSe && $pSe->timezone ==  "Australia/Broken_Hill" ) selected @endif value="Australia/Broken_Hill">Australia/Broken_Hill</option>
                                    <option @if($pSe && $pSe->timezone ==  "Australia/Darwin" ) selected @endif value="Australia/Darwin">Australia/Darwin</option>
                                    <option @if($pSe && $pSe->timezone ==  "Australia/Eucla" ) selected @endif value="Australia/Eucla">Australia/Eucla</option>
                                    <option @if($pSe && $pSe->timezone ==  "Australia/Hobart" ) selected @endif value="Australia/Hobart">Australia/Hobart</option>
                                    <option @if($pSe && $pSe->timezone ==  "Australia/Lindeman" ) selected @endif value="Australia/Lindeman">Australia/Lindeman</option>
                                    <option @if($pSe && $pSe->timezone ==  "Australia/Lord_Howe" ) selected @endif value="Australia/Lord_Howe">Australia/Lord_Howe</option>
                                    <option @if($pSe && $pSe->timezone ==  "Australia/Melbourne" ) selected @endif value="Australia/Melbourne">Australia/Melbourne</option>
                                    <option @if($pSe && $pSe->timezone ==  "Australia/Perth" ) selected @endif value="Australia/Perth">Australia/Perth</option>
                                    <option @if($pSe && $pSe->timezone ==  "Australia/Sydney" ) selected @endif value="Australia/Sydney">Australia/Sydney</option>
                                    <option @if($pSe && $pSe->timezone ==  "Europe/Amsterdam" ) selected @endif value="Europe/Amsterdam">Europe/Amsterdam</option>
                                    <option @if($pSe && $pSe->timezone ==  "Europe/Andorra" ) selected @endif value="Europe/Andorra">Europe/Andorra</option>
                                    <option @if($pSe && $pSe->timezone ==  "Europe/Astrakhan" ) selected @endif value="Europe/Astrakhan">Europe/Astrakhan</option>
                                    <option @if($pSe && $pSe->timezone ==  "Europe/Athens" ) selected @endif value="Europe/Athens">Europe/Athens</option>
                                    <option @if($pSe && $pSe->timezone ==  "Europe/Belgrade" ) selected @endif value="Europe/Belgrade">Europe/Belgrade</option>
                                    <option @if($pSe && $pSe->timezone ==  "Europe/Berlin" ) selected @endif value="Europe/Berlin">Europe/Berlin</option>
                                    <option @if($pSe && $pSe->timezone ==  "Europe/Bratislava" ) selected @endif value="Europe/Bratislava">Europe/Bratislava</option>
                                    <option @if($pSe && $pSe->timezone ==  "Europe/Brussels" ) selected @endif value="Europe/Brussels">Europe/Brussels</option>
                                    <option @if($pSe && $pSe->timezone ==  "Europe/Bucharest" ) selected @endif value="Europe/Bucharest">Europe/Bucharest</option>
                                    <option @if($pSe && $pSe->timezone ==  "Europe/Budapest" ) selected @endif value="Europe/Budapest">Europe/Budapest</option>
                                    <option @if($pSe && $pSe->timezone ==  "Europe/Busingen" ) selected @endif value="Europe/Busingen">Europe/Busingen</option>
                                    <option @if($pSe && $pSe->timezone ==  "Europe/Chisinau" ) selected @endif value="Europe/Chisinau">Europe/Chisinau</option>
                                    <option @if($pSe && $pSe->timezone ==  "Europe/Copenhagen" ) selected @endif value="Europe/Copenhagen">Europe/Copenhagen</option>
                                    <option @if($pSe && $pSe->timezone ==  "Europe/Dublin" ) selected @endif value="Europe/Dublin">Europe/Dublin</option>
                                    <option @if($pSe && $pSe->timezone ==  "Europe/Gibraltar" ) selected @endif value="Europe/Gibraltar">Europe/Gibraltar</option>
                                    <option @if($pSe && $pSe->timezone ==  "Europe/Guernsey" ) selected @endif value="Europe/Guernsey">Europe/Guernsey</option>
                                    <option @if($pSe && $pSe->timezone ==  "Europe/Helsinki" ) selected @endif value="Europe/Helsinki">Europe/Helsinki</option>
                                    <option @if($pSe && $pSe->timezone ==  "Europe/Isle_of_Man" ) selected @endif value="Europe/Isle_of_Man">Europe/Isle_of_Man</option>
                                    <option @if($pSe && $pSe->timezone ==  "Europe/Istanbul" ) selected @endif value="Europe/Istanbul">Europe/Istanbul</option>
                                    <option @if($pSe && $pSe->timezone ==  "Europe/Jersey" ) selected @endif value="Europe/Jersey">Europe/Jersey</option>
                                    <option @if($pSe && $pSe->timezone ==  "Europe/Kaliningrad" ) selected @endif value="Europe/Kaliningrad">Europe/Kaliningrad</option>
                                    <option @if($pSe && $pSe->timezone ==  "Europe/Kirov" ) selected @endif value="Europe/Kirov">Europe/Kirov</option>
                                    <option @if($pSe && $pSe->timezone ==  "Europe/Kyiv" ) selected @endif value="Europe/Kyiv">Europe/Kyiv</option>
                                    <option @if($pSe && $pSe->timezone ==  "Europe/Lisbon" ) selected @endif value="Europe/Lisbon">Europe/Lisbon</option>
                                    <option @if($pSe && $pSe->timezone ==  "Europe/Ljubljana" ) selected @endif value="Europe/Ljubljana">Europe/Ljubljana</option>
                                    <option @if($pSe && $pSe->timezone ==  "Europe/London" ) selected @endif value="Europe/London">Europe/London</option>
                                    <option @if($pSe && $pSe->timezone ==  "Europe/Luxembourg" ) selected @endif value="Europe/Luxembourg">Europe/Luxembourg</option>
                                    <option @if($pSe && $pSe->timezone ==  "Europe/Madrid" ) selected @endif value="Europe/Madrid">Europe/Madrid</option>
                                    <option @if($pSe && $pSe->timezone ==  "Europe/Malta" ) selected @endif value="Europe/Malta">Europe/Malta</option>
                                    <option @if($pSe && $pSe->timezone ==  "Europe/Mariehamn" ) selected @endif value="Europe/Mariehamn">Europe/Mariehamn</option>
                                    <option @if($pSe && $pSe->timezone ==  "Europe/Minsk" ) selected @endif value="Europe/Minsk">Europe/Minsk</option>
                                    <option @if($pSe && $pSe->timezone ==  "Europe/Monaco" ) selected @endif value="Europe/Monaco">Europe/Monaco</option>
                                    <option @if($pSe && $pSe->timezone ==  "Europe/Moscow" ) selected @endif value="Europe/Moscow">Europe/Moscow</option>
                                    <option @if($pSe && $pSe->timezone ==  "Europe/Oslo" ) selected @endif value="Europe/Oslo">Europe/Oslo</option>
                                    <option @if($pSe && $pSe->timezone ==  "Europe/Paris" ) selected @endif value="Europe/Paris">Europe/Paris</option>
                                    <option @if($pSe && $pSe->timezone ==  "Europe/Podgorica" ) selected @endif value="Europe/Podgorica">Europe/Podgorica</option>
                                    <option @if($pSe && $pSe->timezone ==  "Europe/Prague" ) selected @endif value="Europe/Prague">Europe/Prague</option>
                                    <option @if($pSe && $pSe->timezone ==  "Europe/Riga" ) selected @endif value="Europe/Riga">Europe/Riga</option>
                                    <option @if($pSe && $pSe->timezone ==  "Europe/Rome" ) selected @endif value="Europe/Rome">Europe/Rome</option>
                                    <option @if($pSe && $pSe->timezone ==  "Europe/Samara" ) selected @endif value="Europe/Samara">Europe/Samara</option>
                                    <option @if($pSe && $pSe->timezone ==  "Europe/San_Marino" ) selected @endif value="Europe/San_Marino">Europe/San_Marino</option>
                                    <option @if($pSe && $pSe->timezone ==  "Europe/Sarajevo" ) selected @endif value="Europe/Sarajevo">Europe/Sarajevo</option>
                                    <option @if($pSe && $pSe->timezone ==  "Europe/Saratov" ) selected @endif value="Europe/Saratov">Europe/Saratov</option>
                                    <option @if($pSe && $pSe->timezone ==  "Europe/Simferopol" ) selected @endif value="Europe/Simferopol">Europe/Simferopol</option>
                                    <option @if($pSe && $pSe->timezone ==  "Europe/Skopje" ) selected @endif value="Europe/Skopje">Europe/Skopje</option>
                                    <option @if($pSe && $pSe->timezone ==  "Europe/Sofia" ) selected @endif value="Europe/Sofia">Europe/Sofia</option>
                                    <option @if($pSe && $pSe->timezone ==  "Europe/Stockholm" ) selected @endif value="Europe/Stockholm">Europe/Stockholm</option>
                                    <option @if($pSe && $pSe->timezone ==  "Europe/Tallinn" ) selected @endif value="Europe/Tallinn">Europe/Tallinn</option>
                                    <option @if($pSe && $pSe->timezone ==  "Europe/Tirane" ) selected @endif value="Europe/Tirane">Europe/Tirane</option>
                                    <option @if($pSe && $pSe->timezone ==  "Europe/Ulyanovsk" ) selected @endif value="Europe/Ulyanovsk">Europe/Ulyanovsk</option>
                                    <option @if($pSe && $pSe->timezone ==  "Europe/Vaduz" ) selected @endif value="Europe/Vaduz">Europe/Vaduz</option>
                                    <option @if($pSe && $pSe->timezone ==  "Europe/Vatican" ) selected @endif value="Europe/Vatican">Europe/Vatican</option>
                                    <option @if($pSe && $pSe->timezone ==  "Europe/Vienna" ) selected @endif value="Europe/Vienna">Europe/Vienna</option>
                                    <option @if($pSe && $pSe->timezone ==  "Europe/Vilnius" ) selected @endif value="Europe/Vilnius">Europe/Vilnius</option>
                                    <option @if($pSe && $pSe->timezone ==  "Europe/Volgograd" ) selected @endif value="Europe/Volgograd">Europe/Volgograd</option>
                                    <option @if($pSe && $pSe->timezone ==  "Europe/Warsaw" ) selected @endif value="Europe/Warsaw">Europe/Warsaw</option>
                                    <option @if($pSe && $pSe->timezone ==  "Europe/Zagreb" ) selected @endif value="Europe/Zagreb">Europe/Zagreb</option>
                                    <option @if($pSe && $pSe->timezone ==  "Europe/Zurich" ) selected @endif value="Europe/Zurich">Europe/Zurich</option>
                                    <option @if($pSe && $pSe->timezone ==  "Indian/Antananarivo" ) selected @endif value="Indian/Antananarivo">Indian/Antananarivo</option>
                                    <option @if($pSe && $pSe->timezone ==  "Indian/Chagos" ) selected @endif value="Indian/Chagos">Indian/Chagos</option>
                                    <option @if($pSe && $pSe->timezone ==  "Indian/Christmas" ) selected @endif value="Indian/Christmas">Indian/Christmas</option>
                                    <option @if($pSe && $pSe->timezone ==  "Indian/Cocos" ) selected @endif value="Indian/Cocos">Indian/Cocos</option>
                                    <option @if($pSe && $pSe->timezone ==  "Indian/Comoro" ) selected @endif value="Indian/Comoro">Indian/Comoro</option>
                                    <option @if($pSe && $pSe->timezone ==  "Indian/Kerguelen" ) selected @endif value="Indian/Kerguelen">Indian/Kerguelen</option>
                                    <option @if($pSe && $pSe->timezone ==  "Indian/Mahe" ) selected @endif value="Indian/Mahe">Indian/Mahe</option>
                                    <option @if($pSe && $pSe->timezone ==  "Indian/Maldives" ) selected @endif value="Indian/Maldives">Indian/Maldives</option>
                                    <option @if($pSe && $pSe->timezone ==  "Indian/Mauritius" ) selected @endif value="Indian/Mauritius">Indian/Mauritius</option>
                                    <option @if($pSe && $pSe->timezone ==  "Indian/Mayotte" ) selected @endif value="Indian/Mayotte">Indian/Mayotte</option>
                                    <option @if($pSe && $pSe->timezone ==  "Indian/Reunion" ) selected @endif value="Indian/Reunion">Indian/Reunion</option>
                                    <option @if($pSe && $pSe->timezone ==  "Pacific/Apia" ) selected @endif value="Pacific/Apia">Pacific/Apia</option>
                                    <option @if($pSe && $pSe->timezone ==  "Pacific/Auckland" ) selected @endif value="Pacific/Auckland">Pacific/Auckland</option>
                                    <option @if($pSe && $pSe->timezone ==  "Pacific/Bougainville" ) selected @endif value="Pacific/Bougainville">Pacific/Bougainville</option>
                                    <option @if($pSe && $pSe->timezone ==  "Pacific/Chatham" ) selected @endif value="Pacific/Chatham">Pacific/Chatham</option>
                                    <option @if($pSe && $pSe->timezone ==  "Pacific/Chuuk" ) selected @endif value="Pacific/Chuuk">Pacific/Chuuk</option>
                                    <option @if($pSe && $pSe->timezone ==  "Pacific/Easter" ) selected @endif value="Pacific/Easter">Pacific/Easter</option>
                                    <option @if($pSe && $pSe->timezone ==  "Pacific/Efate" ) selected @endif value="Pacific/Efate">Pacific/Efate</option>
                                    <option @if($pSe && $pSe->timezone ==  "Pacific/Fakaofo" ) selected @endif value="Pacific/Fakaofo">Pacific/Fakaofo</option>
                                    <option @if($pSe && $pSe->timezone ==  "Pacific/Fiji" ) selected @endif value="Pacific/Fiji">Pacific/Fiji</option>
                                    <option @if($pSe && $pSe->timezone ==  "Pacific/Funafuti" ) selected @endif value="Pacific/Funafuti">Pacific/Funafuti</option>
                                    <option @if($pSe && $pSe->timezone ==  "Pacific/Galapagos" ) selected @endif value="Pacific/Galapagos">Pacific/Galapagos</option>
                                    <option @if($pSe && $pSe->timezone ==  "Pacific/Gambier" ) selected @endif value="Pacific/Gambier">Pacific/Gambier</option>
                                    <option @if($pSe && $pSe->timezone ==  "Pacific/Guadalcanal" ) selected @endif value="Pacific/Guadalcanal">Pacific/Guadalcanal</option>
                                    <option @if($pSe && $pSe->timezone ==  "Pacific/Guam" ) selected @endif value="Pacific/Guam">Pacific/Guam</option>
                                    <option @if($pSe && $pSe->timezone ==  "Pacific/Honolulu" ) selected @endif value="Pacific/Honolulu">Pacific/Honolulu</option>
                                    <option @if($pSe && $pSe->timezone ==  "Pacific/Kanton" ) selected @endif value="Pacific/Kanton">Pacific/Kanton</option>
                                    <option @if($pSe && $pSe->timezone ==  "Pacific/Kiritimati" ) selected @endif value="Pacific/Kiritimati">Pacific/Kiritimati</option>
                                    <option @if($pSe && $pSe->timezone ==  "Pacific/Kosrae" ) selected @endif value="Pacific/Kosrae">Pacific/Kosrae</option>
                                    <option @if($pSe && $pSe->timezone ==  "Pacific/Kwajalein" ) selected @endif value="Pacific/Kwajalein">Pacific/Kwajalein</option>
                                    <option @if($pSe && $pSe->timezone ==  "Pacific/Majuro" ) selected @endif value="Pacific/Majuro">Pacific/Majuro</option>
                                    <option @if($pSe && $pSe->timezone ==  "Pacific/Marquesas" ) selected @endif value="Pacific/Marquesas">Pacific/Marquesas</option>
                                    <option @if($pSe && $pSe->timezone ==  "Pacific/Midway" ) selected @endif value="Pacific/Midway">Pacific/Midway</option>
                                    <option @if($pSe && $pSe->timezone ==  "Pacific/Nauru" ) selected @endif value="Pacific/Nauru">Pacific/Nauru</option>
                                    <option @if($pSe && $pSe->timezone ==  "Pacific/Niue" ) selected @endif value="Pacific/Niue">Pacific/Niue</option>
                                    <option @if($pSe && $pSe->timezone ==  "Pacific/Norfolk" ) selected @endif value="Pacific/Norfolk">Pacific/Norfolk</option>
                                    <option @if($pSe && $pSe->timezone ==  "Pacific/Noumea" ) selected @endif value="Pacific/Noumea">Pacific/Noumea</option>
                                    <option @if($pSe && $pSe->timezone ==  "Pacific/Pago_Pago" ) selected @endif value="Pacific/Pago_Pago">Pacific/Pago_Pago</option>
                                    <option @if($pSe && $pSe->timezone ==  "Pacific/Palau" ) selected @endif value="Pacific/Palau">Pacific/Palau</option>
                                    <option @if($pSe && $pSe->timezone ==  "Pacific/Pitcairn" ) selected @endif value="Pacific/Pitcairn">Pacific/Pitcairn</option>
                                    <option @if($pSe && $pSe->timezone ==  "Pacific/Pohnpei" ) selected @endif value="Pacific/Pohnpei">Pacific/Pohnpei</option>
                                    <option @if($pSe && $pSe->timezone ==  "Pacific/Port_Moresby" ) selected @endif value="Pacific/Port_Moresby">Pacific/Port_Moresby</option>
                                    <option @if($pSe && $pSe->timezone ==  "Pacific/Rarotonga" ) selected @endif value="Pacific/Rarotonga">Pacific/Rarotonga</option>
                                    <option @if($pSe && $pSe->timezone ==  "Pacific/Saipan" ) selected @endif value="Pacific/Saipan">Pacific/Saipan</option>
                                    <option @if($pSe && $pSe->timezone ==  "Pacific/Tahiti" ) selected @endif value="Pacific/Tahiti">Pacific/Tahiti</option>
                                    <option @if($pSe && $pSe->timezone ==  "Pacific/Tarawa" ) selected @endif value="Pacific/Tarawa">Pacific/Tarawa</option>
                                    <option @if($pSe && $pSe->timezone ==  "Pacific/Tongatapu" ) selected @endif value="Pacific/Tongatapu">Pacific/Tongatapu</option>
                                    <option @if($pSe && $pSe->timezone ==  "Pacific/Wake" ) selected @endif value="Pacific/Wake">Pacific/Wake</option>
                                    <option @if($pSe && $pSe->timezone ==  "Pacific/Wallis" ) selected @endif value="Pacific/Wallis">Pacific/Wallis</option>
                                    <option @if($pSe && $pSe->timezone ==  "UTC" ) selected @endif value="UTC">UTC</option>
                        </select>
                </div> -->
                <div class="col-md-3 mb-4">
                    <label for="name" class="form-label">Default Currency  <span class="text-danger">*</span></label>
                    <select name="currencyid"  data-live-search="true" class="form-control select2" data-size="8" tabindex="null">
                       @foreach($Currency as $Currency)
                          <option value="{{$Currency->id}}">{{$Currency->prefix}}({{$Currency->code}})</option>
                        @endforeach
                       
                    </select>
                </div>
                <div class="col-md-3 mb-4">
                    <label for="name" class="form-label">Language  <span class="text-danger">*</span></label>
                    <select name="Language" class="form-control select2" data-size="8" tabindex="null">
                       <option @if($pSe && $pSe->Language ==  "en" ) selected @endif value="en">English</option>
                    </select>
                </div>
                <!-- <div class="col-md-3 mb-4">
                    <label for="name" class="form-label">Datatable Row Limit   <span class="text-danger">*</span></label>
                    <select name="datatable_row_limit" class="form-control select2" tabindex="null">
                        <option @if($pSe && $pSe->datatable_row_limit ==  "10" ) selected @endif value="10">10</option>
                        <option @if($pSe && $pSe->datatable_row_limit ==  "25" ) selected @endif value="25">25</option>
                        <option @if($pSe && $pSe->datatable_row_limit ==  "50" ) selected @endif value="50">50</option>
                        <option @if($pSe && $pSe->datatable_row_limit ==  "100" ) selected @endif value="100">100</option>
                    </select>
                </div> -->
                <!-- <div class="col-md-3 mb-4">
                    <div class="form-check form-check-primary mt-4">
                        <input class="form-check-input" name="Employeecanexportdata" @if($pSe && $pSe->Employeecanexportdata ==  "on" ) checked @endif type="checkbox" id="customCheckPrimary" >
                        <label class="form-check-label" for="customCheckPrimary">Employee can export data</label>
                      </div>
                </div> -->
                <div class="col-md-12 mb-4 ">
                    <label class="form-label" for="customCheckPrimary">WellCome text (Admin)</label>
                    <div class="editor-container form-control" style="width: 97%; margin-left: 11px;">
                        <div class="full-editor geteditor">@if($pSe && $pSe->welcometext) {!!$pSe->welcometext!!} @endif</div>
                        <input type="hidden" name="welcometext" @if($pSe && $pSe->welcometext) value="{{$pSe->welcometext}}" @endif class="hidden-field">
                    </div>
                </div>
                <div class="col-md-12 mb-4 ">
                    <label class="form-label" for="customCheckPrimary">WellCome text (Employee)</label>
                    <div class="editor-container form-control" style="width: 97%; margin-left: 11px;" >
                        <div class="full-editor geteditor">@if($pSe && $pSe->welcometextEmployee) {!!$pSe->welcometextEmployee!!} @endif</div>
                        <input type="hidden" name="welcometextEmployee" @if($pSe && $pSe->welcometextEmployee) value="{{$pSe->welcometextEmployee}}" @endif class="hidden-field">
                    </div>
                </div>
                <div class="col-md-12 mb-4 ">
                    <label class="form-label" for="customCheckPrimary">WellCome text (Client)</label>
                    <div class="editor-container form-control" style="width: 97%; margin-left: 11px;" >
                        <div class="full-editor geteditor">@if($pSe && $pSe->welcometextClient) {!!$pSe->welcometextClient!!} @endif</div>
                        <input type="hidden" name="welcometextClient" @if($pSe && $pSe->welcometextClient) value="{{$pSe->welcometextClient}}" @endif class="hidden-field">
                    </div>
                </div>
                <div class="col-md-12 row mb-4">
                    <label class="form-label" for="customCheckPrimary">Company Logo</label>
                    <div class="col-md-6">
                        <div class="avatar-preview">
                           <img id="imagePreview" width="100" height="100"  name="CompanyLogo" @if($pSe && $pSe->CompanyLogo) src="{{$pSe->CompanyLogo}}" @endif alt="Preview" />
                        </div>
                  </div>
                  <div class="col-md-6">
                      <div class="avatar-upload">
                        <div class="avatar-edit">
                           <input type="file" class="form-control" id="imageUpload"  name="CompanyLogo"  accept=".png, .jpg" />
                           <label for="imageUpload">Accepted formats: .png, .jpg</label>
                        </div>
                      </div>
                  </div>
                </div>
                <div class="col-md-12 row mb-4">
                    <label class="form-label" for="customCheckPrimary">Company Banner (Admin)</label>
                    <div class="col-md-6">
                        <div class="avatar-preview">
                           <img id="imagePreview" width="100" height="100"  name="CompanyBanner" @if($pSe && $pSe->CompanyBanner) src="{{$pSe->CompanyBanner}}" @endif alt="Preview" />
                        </div>
                  </div>
                  <div class="col-md-6">
                      <div class="avatar-upload">
                        <div class="avatar-edit">
                           <input type="file" class="form-control" id="imageUpload"  name="CompanyBanner"  accept=".png, .jpg" />
                           <label for="imageUpload">Accepted formats: .png, .jpg</label>
                        </div>
                      </div>
                  </div>
                </div>
                <div class="col-md-12 row mb-4">
                    <label class="form-label" for="customCheckPrimary">Company Banner (Employee)</label>
                    <div class="col-md-6">
                        <div class="avatar-preview">
                           <img id="imagePreview" width="100" height="100"  name="CompanyBannerEmployee" @if($pSe && $pSe->CompanyBannerEmployee) src="{{$pSe->CompanyBannerEmployee}}" @endif alt="Preview" />
                        </div>
                  </div>
                  <div class="col-md-6">
                      <div class="avatar-upload">
                        <div class="avatar-edit">
                           <input type="file" class="form-control" id="imageUpload"  name="CompanyBannerEmployee"  accept=".png, .jpg" />
                           <label for="imageUpload">Accepted formats: .png, .jpg</label>
                        </div>
                      </div>
                  </div>
                </div>
                <div class="col-md-12 row mb-4">
                    <label class="form-label" for="customCheckPrimary">Company Banner (Client)</label>
                    <div class="col-md-6">
                        <div class="avatar-preview">
                           <img id="imagePreview" width="100" height="100"  name="CompanyBannerClient" @if($pSe && $pSe->CompanyBannerClient) src="{{$pSe->CompanyBannerClient}}" @endif alt="Preview" />
                        </div>
                  </div>
                  <div class="col-md-6">
                      <div class="avatar-upload">
                        <div class="avatar-edit">
                           <input type="file" class="form-control" id="imageUpload"  name="CompanyBannerClient"  accept=".png, .jpg" />
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
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                // Set the 'src' attribute of the 'img' tag
                $('#imagePreview').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Bind the 'change' event to the file input
    $("#imageUpload").change(function() {
        readURL(this);
    });
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
</script>