<?php

namespace App\Helpers;

class AdminHelper
{
    public static $status = [
        1 => [
            'text' => 'admin.common.draft',
            'class' => 'btn-warning',
        ],
        2 => [
            'text' => 'admin.common.pending',
            'class' => 'btn-warning',
        ],
        3 => [
            'text' => 'admin.common.disable',
            'class' => 'btn-danger',
        ],
        4 => [
            'text' => 'admin.common.enable',
            'class' => 'btn-success',
        ]
    ];

    public static $statusOrder = [
        1 => [
            'text' => 'admin.common.pending',
            'class' => 'btn-warning',
        ],
        2 => [
            'text' => 'admin.common.admin_confirm',
            'class' => 'btn-warning',
        ],
        3 => [
            'text' => 'admin.common.delivery',
            'class' => 'btn-warning',
        ],
        4 => [
            'text' => 'admin.common.customer_cancel',
            'class' => 'btn-danger',
        ],
        5 => [
            'text' => 'admin.common.admin_cancel',
            'class' => 'btn-danger',
        ],
        6 => [
            'text' => 'admin.common.success',
            'class' => 'btn-success',
        ]
    ];

    public static $yesNo = [
        0 => [
            'text' => 'admin.common.no',
            'class' => 'btn-danger',
        ],
        1 => [
            'text' => 'admin.common.yes',
            'class' => 'btn-success',
        ]
    ];

    public static function statusArray()
    {
        $arr = [];
        foreach (self::$status as $k=>$s){
            $arr[$k] = trans($s['text']);
        }

        return $arr;
    }

    public static function statusOrderArray()
    {
        $arr = [];
        foreach (self::$statusOrder as $k=>$s){
            $arr[$k] = trans($s['text']);
        }

        return $arr;
    }

    public static function statusGroup($fieldName, $id, $current)
    {
        $currentInfo = [];
        foreach (self::$status as $value => $info){
            if ($current == $value) {
                $currentInfo = $info;
            }
        }

        $html[] = '<div class="btn-group btn-status-group">';
        $html[] = '<button type="button" class="btn btn-sm '.$currentInfo['class'].'">'.trans($currentInfo['text']).'</button>';
        $html[] = '<button type="button" class="btn btn-sm '.$currentInfo['class'].' dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
        $html[] = '<span class="sr-only">Toggle Dropdown</span>';
        $html[] = '</button>';
        $html[] = '<div class="dropdown-menu">';
        foreach (self::$status as $value => $info){
                $html[] = '<a data-action="update_status"
                    data-id="'.$id.'" data-value="'.$value.'" data-field="'.$fieldName.'"
                    class="dropdown-item option" href="javascript:void(0)">'.trans($info['text']).'</a>';
        }
        $html[] = '</div>';
        $html[] = '</div>';

        return join('', $html);
    }

    public static function statusGroupOrder($fieldName, $id, $current)
    {
        $currentInfo = [];
        foreach (self::$statusOrder as $value => $info){
            if ($current == $value) {
                $currentInfo = $info;
            }
        }

        $html[] = '<div class="btn-group btn-status-group">';
        $html[] = '<button type="button" class="btn btn-sm '.$currentInfo['class'].'">'.trans($currentInfo['text']).'</button>';
        $html[] = '<button type="button" class="btn btn-sm '.$currentInfo['class'].' dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
        $html[] = '<span class="sr-only">Toggle Dropdown</span>';
        $html[] = '</button>';
        $html[] = '<div class="dropdown-menu">';
        foreach (self::$statusOrder as $value => $info){
            $html[] = '<a data-action="update_status"
                    data-id="'.$id.'" data-value="'.$value.'" data-field="'.$fieldName.'"
                    class="dropdown-item option" href="javascript:void(0)">'.trans($info['text']).'</a>';
        }
        $html[] = '</div>';
        $html[] = '</div>';

        return join('', $html);
    }

    public static function yesNoGroup($fieldName, $id, $current)
    {
        $html[] = '<div class="btn-group btn-group-sm btn-status-group" role="group">';
        foreach (self::$yesNo as $value => $info){
            $html[] = '<button href="javascript:void(0)" data-action="update_yesno"  data-id="'.$id.'" data-value="'.$value.'" data-field="'.$fieldName.'"
            type="button" class="option '.($current == $value ? $info['class'] : 'btn-outline-info').' btn ">'.trans($info['text']).'</a>';
        }
        $html[] = '</div>';

        return join('', $html);
    }

    public static function defaultGroup($fieldName, $id, $current)
    {
        $html[] = '<div class="btn-group btn-group-sm btn-status-group" role="group">';
        $html[] = '<button href="javascript:void(0)" data-action="update_default"  data-id="'.$id.'" data-value="1" data-field="'.$fieldName.'"
            type="button" class="option '.($current == 1 ? 'btn-success' : 'btn-outline-info').' btn ">'.trans($current ? 'Yes' : 'No').'</a>';
        $html[] = '</div>';

        return join('', $html);
    }

    public static function orderingBtn($fieldName, $id, $current)
    {
        $html[] = '<span class="btn-order-group" style="width: 50px;">';
        $html[] = '<a href="javascript:void(0);" class="label label-info" data-action="update_ordering" data-id="'.$id.'" data-value="up" data-field="'.$fieldName.'"><i class="la la-angle-up"></i></a> ';
        $html[] = $current;
        $html[] = ' <a href="javascript:void(0);" class="label label-info" data-action="update_ordering" data-id="'.$id.'" data-value="down" data-field="'.$fieldName.'"><i class="la la-angle-down"></i></a>';
        $html[] = '</span>';

        return join('', $html);
    }

    public static function getNumberInput($fieldTitle, $fieldName, $value = '', $required = false, $placeHolder =' ')
    {
        $html[] = '<div class="form-group row">';
        $html[] = '    <label for="example-text-input" class="col-xl-3 col-lg-3 col-form-label">'.$fieldTitle . ($required ? '<span style="color:red">*</span>' : '') .'</label>';
        $html[] = '    <div class="col-lg-9 col-xl-6">';
        $html[] = '<input type="number" '.($required ? 'required' : '').' placeholder="'.$placeHolder.'" class="form-control" minlength="1" maxlength="191" value="'.$value.'" name="'.$fieldName.'"/>';
        $html[] = '    </div>';
        $html[] = '</div>';

        return join('', $html);
    }

    public static function getTextInput($fieldTitle, $fieldName, $value = '', $required = false, $placeHolder =' ', $id = '')
    {
        $html[] = '<div class="form-group row">';
        $html[] = '    <label for="example-text-input" class="col-xl-3 col-lg-3 col-form-label">'.$fieldTitle . ($required ? '<span style="color:red">*</span>' : '') .'</label>';
        $html[] = '    <div class="col-lg-9 col-xl-6">';
        $html[] = '<input type="text" '.($required ? 'required' : '').' placeholder="'.$placeHolder.'" class="form-control" '.($id ? 'id="'.$id.'"' : '').' minlength="1" maxlength="191" value="'.$value.'" name="'.$fieldName.'"/>';
        $html[] = '    </div>';
        $html[] = '</div>';

        return join('', $html);
    }

    public static function getTextInputWithRadio($fieldTitle, $fieldName, $value = '', $required = false, $placeHolder =' ', $id = '', $radioName = '', $radioValue = '', $radioCurrentValue = '')
    {
        $html[] = '<div class="form-group row">';
        $html[] = '    <label for="example-text-input" class="col-xl-3 col-lg-3 col-form-label">'.$fieldTitle . ($required ? '<span style="color:red">*</span>' : '') .'</label>';
        $html[] = '    <div class="col-lg-8 col-xl-5">';
        $html[] = '         <input type="text" '.($required ? 'required' : '').' placeholder="'.$placeHolder.'" class="form-control" '.($id ? 'id="'.$id.'"' : '').' minlength="1" maxlength="191" value="'.$value.'" name="'.$fieldName.'"/>';
        $html[] = '    </div>';
        $html[] = '    <div class="col-lg-1 col-xl-1 d-flex" style="align-items: center">';
        $html[] = '         <input type="radio" name="'. $radioName .'" value="'.$radioValue.'" '. ($radioCurrentValue == $radioValue ? "checked" : "") . '>';
        $html[] = '     </div>';
        $html[] = '</div>';

        return join('', $html);
    }

    public static function getSwitchInput($fieldTitle, $fieldName, $value = '', $required = false, $placeHolder =' ')
    {

        $html[] = '<div class="form-group row">';
        $html[] = '    <label for="example-text-input" class="col-xl-3 col-lg-3 col-form-label">'.$fieldTitle . ($required ? '<span style="color:red">*</span>' : '') .'</label>';
        $html[] = '    <div class="col-lg-9 col-xl-6">';
        $html[] = '    <span class="kt-switch kt-switch--icon">';
        $html[] = '        <label>';
        $html[] = '            <input type="checkbox" '.($value ? 'checked="checked"' : '').' value="1" name="'.$fieldName.'">';
        $html[] = '            <span></span>';
        $html[] = '        </label>';
        $html[] = '    </span>';
        //$html[] = '<input '.($required ? 'required' : '').' placeholder="'.$placeHolder.'" class="form-control" minlength="3" maxlength="191" value="'.$value.'" name="'.$fieldName.'"/>';
        $html[] = '    </div>';
        $html[] = '</div>';

        return join('', $html);
    }

    public static function getPasswordInput($fieldTitle, $fieldName, $value = '', $required = false, $placeHolder =' ')
    {
        $html[] = '<div class="form-group row">';
        $html[] = '    <label for="example-text-input" class="col-xl-3 col-lg-3 col-form-label">'.$fieldTitle . ($required ? '<span style="color:red">*</span>' : '') .'</label>';
        $html[] = '    <div class="col-lg-9 col-xl-6">';
        $html[] = '<input type="password" '.($required ? 'required' : '').' placeholder="'.$placeHolder.'" class="form-control" minlength="3" maxlength="191" value="'.$value.'" name="'.$fieldName.'"/>';
        $html[] = '    </div>';
        $html[] = '</div>';

        return join('', $html);
    }

    public static function getEmailInput($fieldTitle, $fieldName, $value = '', $required = false, $placeHolder =' ')
    {
        $html[] = '<div class="form-group row">';
        $html[] = '    <label for="example-text-input" class="col-xl-3 col-lg-3 col-form-label">'.$fieldTitle . ($required ? '<span style="color:red">*</span>' : '') .'</label>';
        $html[] = '    <div class="col-lg-9 col-xl-6">';
        $html[] = '<input type="email" '.($required ? 'required' : '').' placeholder="'.$placeHolder.'" class="form-control" minlength="3" maxlength="191" value="'.$value.'" name="'.$fieldName.'"/>';
        $html[] = '    </div>';
        $html[] = '</div>';

        return join('', $html);
    }

    public static function getTextareaInput($fieldTitle, $fieldName, $value = '', $required = false, $placeHolder =' ', $id = '')
    {
        $html[] = '<div class="form-group row">';
        $html[] = '    <label for="example-text-input" class="col-lg-3 col-xl-3 col-form-label">'.$fieldTitle . ($required ? '<span style="color:red">*</span>' : '') .'</label>';
        $html[] = '    <div class="col-lg-9 col-xl-6">';
        $html[] = '<textarea '.($required ? 'required' : '').' placeholder="'.$placeHolder.'" class="form-control" '.($id ? 'id="'.$id.'"' : '').' rows="3" name="'.$fieldName.'">'.$value.'</textarea>';
        $html[] = '    </div>';
        $html[] = '</div>';

        return join('', $html);
    }

    public static function getDateInput($fieldTitle, $fieldName, $value = '', $required = false, $placeHolder =' ')
    {
        $inputClass = 'datepiker' . time().rand(1,1000);

        $html[] = '<div class="form-group row">';
        $html[] = '    <label for="example-text-input" class="col-lg-3 col-xl-3 col-form-label">'.$fieldTitle . ($required ? '<span style="color:red">*</span>' : '') .'</label>';
        $html[] = '    <div class="col-lg-9 col-xl-6">';
        $html[] = '         <div class="input-group date">';
        $html[] =                '<input style="max-width:200px" '.($required ? 'required' : '').' type="text" class="form-control" placeholder="'.$placeHolder.'" id="' . $inputClass . '" value="'.$value.'" name="'.$fieldName.'">';
        $html[] =            '<div class="input-group-append">';
        $html[] =                '<span class="input-group-text"><i class="la la-calendar-check-o glyphicon-th"></i></span>';
        $html[] =           '</div>';
        $html[] =       '</div>';
        $html[] = '<script>';
        $html[] = '(function() { setTimeout(function(){
         $("#'. $inputClass .' ").datepicker({
            todayHighlight: true,
            autoclose: true,
            pickerPosition: "bottom-left",
            todayBtn: true,
            format: "yyyy/mm/dd"
        });
         }, 2000); })();';
        $html[] = '</script>';
        $html[] = '    </div>';
        $html[] = '</div>';

        return join('', $html);
    }

    public static function getDateTimeInput($fieldTitle, $fieldName, $value = '', $required = false, $placeHolder =' ')
    {
        $inputClass = 'datepiker' . time().rand(1,1000);

        $html[] = '<div class="form-group row">';
        $html[] = '    <label for="example-text-input" class="col-lg-3 col-xl-3 col-form-label">'.$fieldTitle . ($required ? '<span style="color:red">*</span>' : '') .'</label>';
        $html[] = '    <div class="col-lg-9 col-xl-6">';
        $html[] = '         <div class="input-group date">';
        $html[] =                '<input style="max-width:200px" '.($required ? 'required' : '').' type="text" class="form-control" placeholder="'.$placeHolder.'" id="' . $inputClass . '" value="'.$value.'" name="'.$fieldName.'">';
        $html[] =            '<div class="input-group-append">';
        $html[] =                '<span class="input-group-text"><i class="la la-calendar-check-o glyphicon-th"></i></span>';
        $html[] =           '</div>';
        $html[] =       '</div>';
        $html[] = '<script>';
        $html[] = '(function() { setTimeout(function(){
         $("#'. $inputClass .' ").datetimepicker({
            todayHighlight: true,
            autoclose: true,
            pickerPosition: "bottom-left",
            todayBtn: true,
            format: "yyyy-mm-dd hh:ii:ss"
        });
         }, 2000); })();';
        $html[] = '</script>';
        $html[] = '    </div>';
        $html[] = '</div>';

        return join('', $html);
    }

    public static function getEditorInput($fieldTitle, $fieldName, $value = '', $required = false, $placeHolder =' ', $text = ['insert_image' => 'Chèn Ảnh - Video', 'insert_script' => 'Chèn Mã nhúng Youtube'])
    {
        $inputClass = time().rand(1,1000);

        $html[] = '<div class="form-group row">';
        $html[] = '    <label for="example-text-input" class="col-lg-3 col-xl-3 col-form-label">'.$fieldTitle . ($required ? '<span style="color:red">*</span>' : '') .'</label>';
        $html[] = '    <div class="col-lg-9 col-xl-9">';
        $html[] = '         <textarea '.($required ? 'required' : '').' placeholder="'.$placeHolder.'" class="form-control" id="editor'.$inputClass.'" rows="3" name="'.$fieldName.'">'.$value.'</textarea>';
        $html[] = '         <a data-type="editor" data-value="editor'.$inputClass.'" data-preview="" class="btn btn-outline-primary btn-media btn-sm" href="javascript:void(0);"><i class="la la-picture-o"></i>'.  $text["insert_image"] .'</a>';
        $html[] = '         <a data-type="editor" data-value="editor'.$inputClass.'" class="btn btn-outline-primary btn-embeded btn-sm" href="javascript:void(0);"><i class="la la-code"></i> '. $text["insert_script"] .'</a>';
        $html[] = '    </div>';
        $html[] = '</div>';
        $html[] = '<script>';
        $html[] = '(function() { setTimeout(function(){ CKEDITOR.replace("editor'.$inputClass.'", {allowedContent: true}); }, 2000); })();';
        $html[] = '</script>';

        return join('', $html);
    }

    public static function getCropImageInput($fieldTitle, $fieldName, $value = '', $required = false, $placeHolder =' ', $size='800,600', $id = '')
    {
        $inputClass = time().rand(1,1000);

        $html[] = '<div class="form-group row">';
        $html[] = '    <label for="example-text-input" class="col-lg-3 col-xl-3 col-form-label">'.$fieldTitle . ($required ? '<span style="color:red">*</span>' : '') .' ('.$size.')' .'</label>';
        $html[] = '    <div class="col-lg-9 col-xl-6">';
        $html[] = '    <div class="input-group">';
        $html[] = '         <input '.($required ? 'required' : '').' placeholder="'.$placeHolder.'" class="form-control image_value'.$inputClass.'" minlength="1" maxlength="191" value="'.$value.'" '.($id ? 'id="'.$id.'"' : '').' name="'.$fieldName.'"/>';
        $html[] = '        <div class="input-group-append">';
        $html[] = '            <button data-size="'.$size.'" data-preview=".image_preview'.$inputClass.'" data-value=".image_value'.$inputClass.'" class="btn-crop-image btn btn-primary" type="button">Browse...</button>';
        $html[] = '        </div>';
        $html[] = '    </div>';
        $html[] = '    <img class="image_preview'.$inputClass.'" src="'. url(!empty($value) ? $value : 'assets/lib/images/no-image.jpg') .'" style="width: 100px;">';
        $html[] = '    </div>';
        $html[] = '</div>';

        return join('', $html);
    }

    public static function getSelectMediaInput($fieldTitle, $fieldName, $value = '', $required = false, $placeHolder =' ', $type='text')
    {
        $inputClass = time().rand(1,1000);

        $html[] = '<div class="form-group row">';
        $html[] = '    <label for="example-text-input" class="col-lg-3 col-xl-3 col-form-label">'.$fieldTitle . ($required ? '<span style="color:red">*</span>' : '') .'</label>';
        $html[] = '    <div class="col-lg-9 col-xl-6">';
        $html[] = '    <div class="input-group">';
        $html[] = '         <input '.($required ? 'required' : '').' placeholder="'.$placeHolder.'" class="form-control image_value'.$inputClass.'" minlength="3" maxlength="191" value="'.$value.'" name="'.$fieldName.'"/>';
        $html[] = '        <div class="input-group-append">';
        $html[] = '            <button data-type="'.$type.'" data-preview=".image_preview'.$inputClass.'" data-value=".image_value'.$inputClass.'" class="btn-media btn btn-primary" type="button">Browse...</button>';
        $html[] = '        </div>';
        $html[] = '    </div>';
        $html[] = '    <div class="image_preview'.$inputClass.'" style="width:100px">';
        $html[] = '         <img src="'. url(!empty($value) ? $value : 'assets/lib/images/no-image.jpg') .'" style="width: 100px;">';
        $html[] = '    </div>';
        $html[] = '    </div>';
        $html[] = '</div>';

        return join('', $html);
    }

    public static function getSelectMediaGalleryInput($fieldTitle, $fieldName, $value = '', $required = false, $placeHolder =' ', $type='gallery')
    {
        $inputClass = time().rand(1,1000);

        $html[] = '<div class="form-group row">';
        $html[] = '    <label for="example-text-input" class="col-lg-3 col-xl-3 col-form-label">'.$fieldTitle . ($required ? '<span style="color:red">*</span>' : '') .'</label>';
        $html[] = '    <div class="col-lg-9 col-xl-6">';
        $html[] = '    <div class="input-group">';
        //$html[] = '         <input '.($required ? 'required' : '').' type="hidden" placeholder="'.$placeHolder.'" class="form-control image_value'.$inputClass.'" minlength="1" maxlength="191" value="'.$value.'" name="'.$fieldName.'"/>';
        $html[] = '        <div class="input-group-append">';
        $html[] = '            <button data-type="'.$type.'" data-preview=".image_preview'.$inputClass.'" data-value="'.$fieldName.'" class="btn-media btn btn-primary" type="button">Browse...</button>';
        $html[] = '        </div>';
        $html[] = '    </div>';
        $html[] = '    <div class="image_preview'.$inputClass.'" style="">';
        $value = $value ? json_decode($value) : [];
        foreach ($value as $img => $text) {
            $html[] = '<div class="item" style="width: 150px; height: 150px; overflow: hidden; float: left; margin-right: 10px; position:relative;">';
            $html[] = '<img style="width: 100%; margin-bottom: 0px; height: 100px;" class="thumbnail" alt="' . $text . '" src="' . url($img) . '" />';
            $html[] = '<textarea style="width: 100%;" rows="2" name="'.$fieldName.'[' . $img . ']">' . $text . '</textarea>';
            $html[] = '<a onclick="$(this).parent().prev(\'.item\').before($(this).parent()); return false;" class="btn btn-default btn-sm pull-left" href="#" style="position: absolute; top: 0; right: 60px;"><i class="la la-chevron-left"></i></a>';
            $html[] = '<a onclick="$(this).parent().next(\'.item\').after($(this).parent()); return false;" class="btn btn-default btn-sm pull-left" href="#" style="position: absolute; top: 0; right: 40px;"><i class="la la-chevron-right"></i></a>';
            $html[] = '<a onclick="if(!confirm(\'Bạn có chắc muốn xóa ảnh?\')) return false; $(this).parent().remove(); return false;" class="btn btn-danger btn-xs pull-left" href="#" style="position: absolute; top: 0; right: 0;">Xóa</a>';
            $html[] = '</div>';
        }
        //$html[] = '         <img src="'. url(!empty($value) ? $value.'?v='.time() : 'assets/lib/images/no-image.jpg') .'" style="width: 100px;">';
        $html[] = '    </div>';
        $html[] = '    </div>';
        $html[] = '</div>';

        return join('', $html);
    }

    public static function getSelectInput($fieldTitle, $fieldName, $value = '', $required = false, $options =' ')
    {
        $html[] = '<div class="form-group row">';
        $html[] = '    <label for="example-text-input" class="col-lg-3 col-xl-3 col-form-label">'.$fieldTitle . ($required ? '<span style="color:red">*</span>' : '') .'</label>';
        $html[] = '    <div class="col-lg-9 col-xl-6">';
        $html[] = '        <select '.($required ? 'required' : '').' class="select2 form-control" value="'.$value.'" name="'.$fieldName.'">';
        if($options && count($options)){
            foreach ($options as $k=>$v){
                $html[] = '        <option value="'.$k.'" '.($value == $k ? 'selected' : '').'>'.$v.'</option>';
            }
        }
        $html[] = '        </select>';
        $html[] = '    </div>';
        $html[] = '</div>';

        return join('', $html);
    }

    public static function getSelectInputArray($fieldTitle, $fieldName, $value = '', $required = false, $options =' ')
    {
        $html[] = '<div class="form-group row">';
        $html[] = '    <label for="example-text-input" class="col-lg-3 col-xl-3 col-form-label">'.$fieldTitle . ($required ? '<span style="color:red">*</span>' : '') .'</label>';
        $html[] = '    <div class="col-lg-9 col-xl-6">';
        $html[] = '        <select '.($required ? 'required' : '').' class="form-control" value="'.$value.'" name="'.$fieldName.'">';
        if($options && count($options)){

            foreach ($options as $k=>$v){
                $dataString = '';
                $size = '';
                foreach ($v as $key => $val) {
                    if ($key != 'text') {
                        $dataString .= 'data-' . $key . '="'. $val .'"';
                    }
                }
                if (isset($v['width']) && isset($v['height'])) {
                    $size = ' (' . $v['width'] . ' x ' . $v['height'] . ')';
                }

                $html[] = '    <option value="'.$k.'" ' . ($value == $k ? 'selected ' : '') . $dataString .'>' .$v['text'] . $size . '</option>';
            }
        }
        $html[] = '        </select>';
        $html[] = '    </div>';
        $html[] = '</div>';

        return join('', $html);
    }

    public static function getLogPopup($id, $table)
    {
        $html[] = '<a type="button" id='.$id;
        $html[] = ' target='.$table;
        $html[] = ' class="btn btn-sm btn-clean btn-icon btn-icon-md view-log" data-toggle="modal" data-target="#logModal">
          <i class="la la-eye"></i>
        </a>

        <!-- Modal -->
        <div class="modal fade bd-example-modal-lg" id="logModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Lịch sử thay đổi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Thuộc tính</th>
                      <th scope="col">Trước</th>
                      <th scope="col">Sau</th>
                      <th scope="col">Thời gian</th>
                      <th scope="col">Loại</th>
                      <th scope="col">Người sửa</th>
                    </tr>
                  </thead>
                  <tbody id="data-log">

                  </tbody>
                </table>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>';

        return join('', $html);
    }

}
