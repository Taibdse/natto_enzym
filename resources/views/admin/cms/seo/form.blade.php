<div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>
<h3>SEO Optimization</h3>

{!! \App\Helpers\AdminHelper::getTextInput('Title', 'seo[title]', $item->id ? ($item->seo->title ?? $item->title) : '', false, '','meta-title') !!}
{!! \App\Helpers\AdminHelper::getCropImageInput('Image', 'seo[image]', $item->id ? ($item->seo->image ?? $item->image) : '', false, '', '1200,630', 'meta-url') !!}
{!! \App\Helpers\AdminHelper::getTextareaInput('Description', 'seo[description]', $item->id ? ($item->seo->description ?? $item->introtext) : '', false, '', 'meta-desc') !!}

<div class="row form-group">
    <label class="col-3">
        Preview
    </label>
    <div class="col-9 seo-preview">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <h6>Google Preview</h6>
                <div id="seopreview-google"></div>
            </div>
            <div class="col-lg-6">
                <h6>Facebook Preview</h6>
                <div id="seopreview-facebook"></div>
            </div>
        </div>
    </div>
</div>
