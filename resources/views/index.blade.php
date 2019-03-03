@extends('shetabit-base::master')

@push('app-methods')
<script>
    AppMethods.newPage = function(response) {
        App.pages.pages.items.push(response.data);
        show_notification('success', response.message);
        refresh_selectpicker();
        $('.modal').modal('hide');
    }

    AppMethods.showPage = function()
    {
        var index = $('select#pages').val();
        if(index !== '') {
            var form = App.pages.pages.items[index];
            Vue.set(form, 'index', index);
            Vue.set(App.pages.pages, 'edit', form);
            setTimeout(function(){
                if($('#cke_edit-contents').length == 0) {
                    CKEDITOR.replace('edit-contents');
                }
                CKEDITOR.instances['edit-contents'].setData(App.pages.pages.edit.contents);
            }, 100);
        }
    }

    AppMethods.updatePage = function(response) {
        var index = App.pages.pages.edit.index;
        Vue.set(App.pages.pages.items, index, response.data);
        Vue.set(App.pages.pages, 'edit', response.data);
        Vue.set(App.pages.pages.edit, 'index', index);
        show_notification('success', response.message);
        refresh_selectpicker();
    }
</script>

@endpush

@section('content')


<script>
    App.pages.pages = {
        items: JSON.parse('{!! addslashes(mb_json_encode($pages)) !!}'),
        edit: {},
        path: "{!! route('shetabit.page-builder.pages.index') !!}"
    }
</script>


<div class="form-group">
    <button class="btn btn-primary" @click="openModal('new-page')">اضافه کردن</button>
</div>
<div class="row">
    <div class="col-md-6">
        <panel id="pages">
            <p slot="title">صفحات</p>
            <div slot="body">
                <select name="pages" id="pages" class="selectpicker" data-style="btn btn-white" title="انتخاب کنید" @change="showPage">
                    <option :value="index" v-for="item,index in pages.pages.items">@{{ item.title + ' - ' + item.category.title }}</option>
                </select>
            </div>
        </panel>
    </div>
</div>

<div v-if="!$.isEmptyObject(pages.pages.edit)">
    <panel id="edit-page">
        <p slot="title">@{{ pages.pages.edit.title }}</p>
        <div slot="body">
            <div class="form-inline form-group">
                <code class="pull-right" style="direction:ltr">
                    <a :href="pages.pages.edit.url" target="_blank">@{{ pages.pages.edit.url }}</a>
                </code>
                <div class="clearfix"></div>
            </div>
            <form :action="'{{ route('shetabit.page-builder.pages.index') }}/' + pages.pages.edit.id" method="post" class="js-submit-form" data-on-success="updatePage">
                <div class="form-group">
                    <label for="edit-title">عنوان</label>
                    <input id="edit-title" name="title" type="text" class="form-control" :value="pages.pages.edit.title" data-required>
                </div>
                <div class="form-group">
                    <label for="edit-brief-text">توضیح خلاصه</label>
                    <textarea id="edit-brief-text" name="brief_text" maxlength="255" class="form-control" :value="pages.pages.edit.brief_text"></textarea>
                </div>
                <div class="form-group">
                    <label for="edit-contents">متن</label>
                    <textarea id="edit-contents" name="contents" data-required></textarea>
                </div>
                <div class="row form-group">
                    <div class="col-md-3">
                        <label for="edit-category_id">دسته‌بندی</label>
                        <select name="category_id" id="edit-category_id" class="form-control">

                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="edit-status">وضعیت</label>
                        <select name="status" id="edit-status" class="form-control">
                            <option value="1" :selected="pages.pages.edit.status == 1">فعال</option>
                            <option value="0" :selected="pages.pages.edit.status == 0">غیر فعال</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="edit-priority">اولویت</label>
                        <input id="edit-priority" name="priority" type="number" class="form-control" :value="pages.pages.edit.priority" data-required>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group pull-left">
                            <label for="edit-image">تصویر جدید</label>
                            <input type="file" name="image" id="edit-image">
                        </div>
                        <img v-if="pages.pages.edit.image" :src="base_url + '/assets/images/pages/' + pages.pages.edit.image + '.jpg'" class="pull-right thumbnail thumb-md">
                        <div class="clearfix"></div>
                        <br>
                    </div>
                </div>
                <div class="pull-right">
                    <button class="btn btn-primary">ویرایش</button>
                    <button type="button" @click="deleteItem(pages.pages)" class="btn btn-danger">حذف</button>
                </div>
                <div class="clearfix"></div>
                @csrf
                @method('PUT')
            </form>
        </div>
    </panel>
</div>


<modal-full id="new-page">
    <p slot="title">ثبت صفحه جدید</p>
    <div slot="body">
        <form action="{{ route('shetabit.page-builder.pages.index') }}" method="post" class="js-submit-form" data-on-success="newPage" data-clear-onsuccess="true">
            <div class="form-group">
                <label for="title">عنوان</label>
                <input id="title" name="title" type="text" class="form-control" data-required>
            </div>
            <div class="form-group">
                <label for="brief-text">توضیح خلاصه</label>
                <textarea id="brief-text" name="brief_text" maxlength="255" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label for="contents">متن</label>
                <textarea id="contents" name="contents" data-required></textarea>
            </div>
            <div class="row form-group">
                <div class="col-md-3">
                    <label for="category_id">دسته‌بندی</label>
                    <select name="category_id" id="category_id" class="form-control">

                    </select>
                </div>
                <div class="col-md-3">
                    <label for="status">وضعیت</label>
                    <select name="status" id="status" class="form-control">
                        <option value="1">فعال</option>
                        <option value="0">غیر فعال</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="priority">اولویت</label>
                    <input id="priority" name="priority" type="number" class="form-control" data-required>
                </div>
                <div class="col-md-3">
                    <label for="image">تصویر</label>
                    <input type="file" id="image" name="image">
                </div>
            </div>

            @csrf
            <button class="btn btn-success">ثبت</button>
        </form>
    </div>
</modal-full>

@endsection

@push('scripts')
<script src="{!! config('base.assets_path') !!}/editors/ckeditor/ckeditor.js"></script>
<script>
    $(document).ready(function(){
        CKEDITOR.replace('contents');
    });
</script>
@endpush