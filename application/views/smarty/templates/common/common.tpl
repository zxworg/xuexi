{extends file="parent/common.tpl"}
{block name = 'title'}
    welcome
{/block}
{block name = 'link_css'}
    <link rel="stylesheet" href="css/header.css">
{/block}
{block name = "content"}
    <div style="width: 900px;border:red 1px solid;">
        {include file = 'common/header.tpl'}
        {block name = "real_content"}{/block}
        {include file = 'common/footer.tpl'}
    </div>
{/block}