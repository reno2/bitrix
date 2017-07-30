<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<!doctype html>
<html>
<head>
	<?$APPLICATION->ShowHead()?>
	<title><?$APPLICATION->ShowTitle()?></title>
	<link href="https://fonts.googleapis.com/css?family=Exo+2:200,400,900&amp;subset=cyrillic" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=PT+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
	<?
		CJSCore::Init(array("jquery"));
		// Пример подключения js $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/jquery.sudoSlider.min.js" );
		$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/owl.carousel.min.js" );
		$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/common.js" );
	?>
	
	<? 
	//Пример подключения css $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/type.css");
		$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/bootstrap-grid.css");
		$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/owl.theme.default.css");
		$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/owl.carousel.min.css");
	?>
	<link rel="shortcut icon" href="<?=SITE_TEMPLATE_PATH?>/images/favicon.ico" />
</head>
<body>
<?$APPLICATION->ShowPanel();?>

<div class="header">
	<div class="top-wr">
		<div class="container">
			<div class="row">
				<div class="col-md-3">
					<a href="/" title="" class="top_logo">
						<img  src="<?=SITE_TEMPLATE_PATH?>/img/logo.png" />
					</a>
				</div>
				<div class="col-md-6">
					<div class="s-w">
				<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.search", 
	".default", 
	array(
		"COMPONENT_TEMPLATE" => ".default",
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID" => "3",
		"ELEMENT_SORT_FIELD" => "sort",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER2" => "desc",
		"HIDE_NOT_AVAILABLE" => "N",
		"PAGE_ELEMENT_COUNT" => "30",
		"LINE_ELEMENT_COUNT" => "3",
		"PROPERTY_CODE" => array(
			0 => "ATT_SKU",
			1 => "ATT_CODE",
			2 => "ATT_BRAND",
			3 => "ATT_PRICE",
			4 => "",
		),
		"OFFERS_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"OFFERS_PROPERTY_CODE" => array(
			0 => "ATT_SIZE",
			1 => "ATT_COLOR",
			2 => "",
		),
		"OFFERS_SORT_FIELD" => "sort",
		"OFFERS_SORT_ORDER" => "asc",
		"OFFERS_SORT_FIELD2" => "id",
		"OFFERS_SORT_ORDER2" => "desc",
		"OFFERS_LIMIT" => "5",
		"SECTION_URL" => "",
		"DETAIL_URL" => "/catalog/#SECTION_CODE#/#ELEMENT_CODE#/",
		"BASKET_URL" => "/personal/basket.php",
		"ACTION_VARIABLE" => "action",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"DISPLAY_COMPARE" => "N",
		"PRICE_CODE" => array(
			0 => "BASE",
		),
		"USE_PRICE_COUNT" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"PRICE_VAT_INCLUDE" => "Y",
		"USE_PRODUCT_QUANTITY" => "N",
		"CONVERT_CURRENCY" => "N",
		"OFFERS_CART_PROPERTIES" => array(
		),
		"RESTART" => "N",
		"NO_WORD_LOGIC" => "N",
		"USE_LANGUAGE_GUESS" => "Y",
		"CHECK_DATES" => "N",
		"PAGER_TEMPLATE" => ".default",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Товары",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N"
	),
	false
);?>
					</div>
				</div>
				<div class="col-md-3">
					<div class="mini_cart">
							<div class="bag-w">
								<a href="" class="w">
									<img class="bag" src="<?=SITE_TEMPLATE_PATH?>/img/bag.png">
									<span class="qunt">15</span>
								</a>  
								<span class="total">10 000 руб.</span>
							</div>
					</div>
				</div>
			</div>
		</div>
	</div>	
	 <?if ($APPLICATION->GetCurDir()=='/'):?>
		<div class="slider">
			<div class="clearfix7">
			<div id="owl" class="owl-carousel owl-theme">
				<?if (CModule::IncludeModule("iblock")):
					// ID инфоблока из которого выводим элементы
					$iblock_id = 1;
					$my_slider = CIBlockElement::GetList (
					// Сортировка элементов
						Array("ID" => "ASC"),
						Array("IBLOCK_ID" => $iblock_id),
						false,
						false,
						// Перечисляесм все свойства элементов, которые планируем выводить
						Array(
						'ID', 
						'NAME', 
						'PREVIEW_PICTURE', 
						'PREVIEW_TEXT', 
						'ATT_LINK'
						)
					);
					while($ar_fields = $my_slider->GetNext())
					{
					//Выводим элемент со всеми свойствами + верстка
						$img_path = CFile::GetPath($ar_fields["PREVIEW_PICTURE"]);
						echo '<div>';
						echo '<img src="' . $img_path . '">';
						echo '</div>';
					}
					endif;?>
				</div>
			</div>	
		</div>
	 <?php endif; ?>	
</div>
<div class="content">
	<div class="container">

