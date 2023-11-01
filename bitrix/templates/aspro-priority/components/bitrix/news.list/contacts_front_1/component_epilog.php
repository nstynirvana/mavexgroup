<?if($templateData['MAP_ITEMS']) {?>
    <?if ($templateData['MAP_PLACEMARK']) { ?>
        <div class="col-md-6 item">
            <div class="right_block">
                <?if (CPriority::GetFrontParametrValue('CONTACTS_TYPE_MAP') == 'GOOGLE') {?>
                    <?$APPLICATION->IncludeComponent(
                    "bitrix:map.google.view", 
                    "map", 
                    array(
                        "API_KEY" => \Bitrix\Main\Config\Option::get("fileman","google_map_api_key",""),
                        "COMPONENT_TEMPLATE" => "map",
                        "COMPOSITE_FRAME_MODE" => "A",
                        "COMPOSITE_FRAME_TYPE" => "AUTO",
                        "CONTROLS" => array(
                            0 => "SMALL_ZOOM_CONTROL",
                            1 => "TYPECONTROL",
                        ),
                        "INIT_MAP_TYPE" => "ROADMAP",
                        "MAP_DATA" => serialize(array("google_lat" => $templateData['MAP_PLACEMARK'][0]['LAT'], "google_lon" => $templateData['MAP_PLACEMARK'][0]['LON'], "google_scale" => 15, "PLACEMARKS" => $templateData['MAP_PLACEMARK'])),
                        "MAP_HEIGHT" => "650px",
                        "MAP_ID" => "",
                        "MAP_WIDTH" => "100%",
                        "OPTIONS" => array(
                            0 => "ENABLE_DBLCLICK_ZOOM",
                            1 => "ENABLE_DRAGGING",
                        ),
                        "USE_REGION_DATA" => "Y"
                    ),
                        false
                    );?>
                    <?}?>
                    <?if(CPriority::GetFrontParametrValue('CONTACTS_TYPE_MAP') == 'YANDEX') {?>	
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:map.yandex.view",
                        "map",
                        array(
                            "INIT_MAP_TYPE" => "MAP",
                            "MAP_DATA" => serialize(array("yandex_lat" => $templateData['MAP_PLACEMARK'][0]['LAT'], "yandex_lon" => $templateData['MAP_PLACEMARK'][0]['LON'], "yandex_scale" => 15, "PLACEMARKS" => $templateData['MAP_PLACEMARK'])),
                            "MAP_WIDTH" => "100%",
                            "MAP_HEIGHT" => "650",
                            "CONTROLS" => array(
                                0 => "ZOOM",
                                1 => "TYPECONTROL",
                                2 => "SCALELINE",
                            ),
                            "OPTIONS" => array(
                                0 => "ENABLE_DBLCLICK_ZOOM",
                                1 => "ENABLE_DRAGGING",
                            ),
                            "MAP_ID" => "MAP_v33",
                            "COMPONENT_TEMPLATE" => "map"
                        ),
                        false
                    );?>
                <?}?>	
            </div>
       </div>
    <?}?>
    </div>  <!-- closet div template begin-->
</div> <!-- end -->
<?}?> 
