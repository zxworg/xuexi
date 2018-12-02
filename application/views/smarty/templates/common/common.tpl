{extends file="parent/common.tpl"}
{block name = 'title'}
    test
{/block}
{block name = "content"}
    {include file = 'common/header.tpl'}
    {block name = "real_content"}{/block}
    {include file = 'common/footer.tpl'}
{/block}