<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="container">
	<div class="row">
		<div class="col-md-3">
			<?$APPLICATION->IncludeComponent(
				"bitrix:catalog.section.list",
				"",
				Array(
					"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
					"IBLOCK_ID" => $arParams["IBLOCK_ID"],
					"DISPLAY_PANEL" => $arParams["DISPLAY_PANEL"],
					"CACHE_TYPE" => $arParams["CACHE_TYPE"],
					"CACHE_TIME" => $arParams["CACHE_TIME"],
					"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
					"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"]
				),
				$component
			);
			?>

			<?
			if (CModule::IncludeModule("iblock"))
			{
			    $arFilter = array(
			        "ACTIVE" => "Y",
			        "GLOBAL_ACTIVE" => "Y",
			        "IBLOCK_ID" => $arParams["IBLOCK_ID"],
			    );
			    if(strlen($arResult["VARIABLES"]["SECTION_CODE"])>0)
			    {
			        $arFilter["=CODE"] = $arResult["VARIABLES"]["SECTION_CODE"];
			    }
			    elseif($arResult["VARIABLES"]["SECTION_ID"]>0)
			    {
			        $arFilter["ID"] = $arResult["VARIABLES"]["SECTION_ID"];
			    }
			        
			    $obCache = new CPHPCache;
			    if($obCache->InitCache(36000, serialize($arFilter), "/iblock/catalog"))
			    {
			        $arCurSection = $obCache->GetVars();
			    }
			    else
			    {
			        $arCurSection = array();
			        $dbRes = CIBlockSection::GetList(array(), $arFilter, false, array("ID"));
			        $dbRes = new CIBlockResult($dbRes);
			   if(defined("BX_COMP_MANAGED_CACHE"))
			        {
			            global $CACHE_MANAGER;
			            $CACHE_MANAGER->StartTagCache("/iblock/catalog");

			            if ($arCurSection = $dbRes->GetNext())
			            {
			                $CACHE_MANAGER->RegisterTag("iblock_id_".$arParams["IBLOCK_ID"]);
			            }
			            $CACHE_MANAGER->EndTagCache();
			        }
			        else
			        {
			            if(!$arCurSection = $dbRes->GetNext())
			                $arCurSection = array();
			        }
			      $obCache->EndDataCache($arCurSection);
			    }
			    ?>
			   <?$APPLICATION->IncludeComponent(
			      "bitrix:catalog.smart.filter",
			      "visual_vertical",
			      Array(
			         "PRICE_CODE" => array(0=>$arParams["PRICE_CODE"],),
			         "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
			         "IBLOCK_ID" => $arParams["IBLOCK_ID"],
			         "SECTION_ID" => $arCurSection['ID'],
			         "FILTER_NAME" => $arParams["FILTER_NAME"],
			         "CACHE_TYPE" => $arParams["CACHE_TYPE"],
			         "CACHE_TIME" => $arParams["CACHE_TIME"],
			         "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
			         "SAVE_IN_SESSION" => "N",
			         "XML_EXPORT" => "Y",
			         "SECTION_TITLE" => "NAME",
			         "SECTION_DESCRIPTION" => "DESCRIPTION",
			         'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],
			         "TEMPLATE_THEME" => $arParams["TEMPLATE_THEME"]
			      ),
			      $component,
			      array('HIDE_ICONS' => 'Y')
			   );?>
			<?}?>
 
		</div>

		<div class="col-md-9">
			<?if($arParams["SHOW_TOP_ELEMENTS"]!="N"):?>
				<hr />
				<?$APPLICATION->IncludeComponent(
					"bitrix:catalog.top",
					"",
					Array(
						"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
						"IBLOCK_ID" => $arParams["IBLOCK_ID"],
						"ELEMENT_SORT_FIELD" => $arParams["TOP_ELEMENT_SORT_FIELD"],
						"ELEMENT_SORT_ORDER" => $arParams["TOP_ELEMENT_SORT_ORDER"],
						"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
						"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
						"BASKET_URL" => $arParams["BASKET_URL"],
						"ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
						"PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
						"SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
						"DISPLAY_COMPARE" => $arParams["USE_COMPARE"],
						"ELEMENT_COUNT" => $arParams["TOP_ELEMENT_COUNT"],
						"LINE_ELEMENT_COUNT" => $arParams["TOP_LINE_ELEMENT_COUNT"],
						"PROPERTY_CODE" => $arParams["TOP_PROPERTY_CODE"],
						"PRICE_CODE" => $arParams["PRICE_CODE"],
						"USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
						"SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],
						"PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
						"PRICE_VAT_SHOW_VALUE" => $arParams["PRICE_VAT_SHOW_VALUE"],
						"CACHE_TYPE" => $arParams["CACHE_TYPE"],
						"CACHE_TIME" => $arParams["CACHE_TIME"],
						"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
						"OFFERS_CART_PROPERTIES" => $arParams["OFFERS_CART_PROPERTIES"],
						"OFFERS_FIELD_CODE" => $arParams["TOP_OFFERS_FIELD_CODE"],
						"OFFERS_PROPERTY_CODE" => $arParams["TOP_OFFERS_PROPERTY_CODE"],
						"OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
						"OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
						"OFFERS_LIMIT" => $arParams["TOP_OFFERS_LIMIT"],
					),
				$component
				);?>
			<?endif?>
		</div>
	</div>
</div>



<?if($arParams["USE_COMPARE"]=="Y"):?>
	<?$APPLICATION->IncludeComponent(
		"bitrix:catalog.compare.list",
		"",
		Array(
			"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
			"IBLOCK_ID" => $arParams["IBLOCK_ID"],
			"NAME" => $arParams["COMPARE_NAME"],
			"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
			"COMPARE_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["compare"],
		),
		$component
	);?>
<br />
<?endif?>


