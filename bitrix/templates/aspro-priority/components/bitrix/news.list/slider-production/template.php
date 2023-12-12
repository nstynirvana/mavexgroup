<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
?>
<? /*
<div class="col-md-9  sim-slider">

    <ul class="sim-slider-list">

        <? foreach ($arResult["ITEMS"] as $arItem): ?>
            <?
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>

            <li class="sim-slider-element" id="<?= $this->GetEditAreaId($arItem['ID']); ?>" data-fancybox="gallery-3">
                <img class="sim-slider-element-img" src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>"
                     alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>" title="<?= $arItem["PREVIEW_PICTURE"]["TITLE"] ?>">
            </li>

        <? endforeach; ?>

    </ul>

</div>
*/ ?>
<? /*
<div class="slider-container">
    <button type="button" role="presentation" aria-label="Previous" class="owl-prev"><i
                class="svg left colored_theme_hover_text">
            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="6.969" viewBox="0 0 12 6.969">
                <path id="Rounded_Rectangle_702_copy_24" data-name="Rounded Rectangle 702 copy 24" class="cls-1"
                      d="M361.691,401.707a1,1,0,0,1-1.414,0L356,397.416l-4.306,4.291a1,1,0,0,1-1.414,0,0.991,0.991,0,0,1,0-1.406l5.016-5a1.006,1.006,0,0,1,1.415,0l4.984,5A0.989,0.989,0,0,1,361.691,401.707Z"
                      transform="translate(-350 -395.031)"></path>
            </svg>
        </i></button>
    <ul class="slider">
        <? foreach ($arResult["ITEMS"] as $arItem): ?>
            <?
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>
            <li class="sim-slider-element" id="<?= $this->GetEditAreaId($arItem['ID']); ?>" data-fancybox="gallery-3">
                <img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>"
                     title="<?= $arItem["PREVIEW_PICTURE"]["TITLE"] ?>">
            </li>
        <? endforeach; ?>
    </ul>
    <button type="button" role="presentation" class="owl-next"><i class="svg right colored_theme_hover_text">
            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="6.969" viewBox="0 0 12 6.969">
                <path id="Rounded_Rectangle_702_copy_24" data-name="Rounded Rectangle 702 copy 24" class="cls-1"
                      d="M361.691,401.707a1,1,0,0,1-1.414,0L356,397.416l-4.306,4.291a1,1,0,0,1-1.414,0,0.991,0.991,0,0,1,0-1.406l5.016-5a1.006,1.006,0,0,1,1.415,0l4.984,5A0.989,0.989,0,0,1,361.691,401.707Z"
                      transform="translate(-350 -395.031)"></path>
            </svg>
        </i></button>
</div>
*/ ?>


<div class="big-gallery-block owl-carousel slider-carousel owl-theme owl-bg-nav short-nav owl-loaded owl-drag" id="slider"
     data-plugin-options="{&quot;items&quot;: &quot;1&quot;, &quot;autoplay&quot; : false, &quot;autoplayTimeout&quot; : &quot;3000&quot;, &quot;smartSpeed&quot;:1000, &quot;dots&quot;: false, &quot;nav&quot;: true, &quot;loop&quot;: false, &quot;rewind&quot;:true, &quot;index&quot;: true, &quot;margin&quot;: 10}">
    <div class="owl-stage-outer" >
        <div class="owl-stage slider"
             style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 3030px;">
            <? foreach ($arResult["ITEMS"] as $arItem): ?>
                <?
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>
                <div class="owl-item active current" style="width: 1000px; margin-right: 10px;">
                    <div class="col-md-12 item">
                        <a href="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" class="fancybox" rel="gallery"
                           target="_blank" id="<?= $this->GetEditAreaId($arItem['ID']); ?>" style="
    width: fit-content;
    display: flex;">
                            <img data-lazyload=""
                                 src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>"
                                 alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>"
                                 title="<?= $arItem["PREVIEW_PICTURE"]["TITLE"] ?>"
                                 data-src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>"
                                 class="img-responsive inline ls-is-cached lazyloaded">
                        </a>
                    </div>
                </div>
            <? endforeach; ?>
        </div>
    </div>
    <div class="owl-nav">
        <button type="button" role="presentation" class="owl-prev"><i class="svg left colored_theme_hover_text">
                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="6.969" viewBox="0 0 12 6.969">
                    <path id="Rounded_Rectangle_702_copy_24" data-name="Rounded Rectangle 702 copy 24" class="cls-1"
                          d="M361.691,401.707a1,1,0,0,1-1.414,0L356,397.416l-4.306,4.291a1,1,0,0,1-1.414,0,0.991,0.991,0,0,1,0-1.406l5.016-5a1.006,1.006,0,0,1,1.415,0l4.984,5A0.989,0.989,0,0,1,361.691,401.707Z"
                          transform="translate(-350 -395.031)"></path>
                </svg>
            </i></button>
        <button type="button" role="presentation" class="owl-next"><i class="svg right colored_theme_hover_text">
                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="6.969" viewBox="0 0 12 6.969">
                    <path id="Rounded_Rectangle_702_copy_24" data-name="Rounded Rectangle 702 copy 24" class="cls-1"
                          d="M361.691,401.707a1,1,0,0,1-1.414,0L356,397.416l-4.306,4.291a1,1,0,0,1-1.414,0,0.991,0.991,0,0,1,0-1.406l5.016-5a1.006,1.006,0,0,1,1.415,0l4.984,5A0.989,0.989,0,0,1,361.691,401.707Z"
                          transform="translate(-350 -395.031)"></path>
                </svg>
            </i></button>
    </div>
    <div class="owl-dots disabled"></div>
</div>



