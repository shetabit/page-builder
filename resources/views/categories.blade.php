@extends('shetabit-base::master')

@push('app-methods')
<script>
    AppMethods.newPageCategory = function(response) {
        App.pages.page_categories.items.push(response.data);
        show_notification('success', response.message);
        refresh_selectpicker();
        $('.modal').modal('hide');
    }

    AppMethods.showPageCategory = function()
    {
        var index = $('select#pages').val();
        if(index !== '') {
            var form = App.pages.page_categories.items[index];
            Vue.set(form, 'index', index);
            Vue.set(App.pages.page_categories, 'edit', form);
        }
        refresh_selectpicker();
    }

    AppMethods.updatePageCategory = function(response) {
        var index = App.pages.page_categories.edit.index;
        Vue.set(App.pages.page_categories.items, index, response.data);
        Vue.set(App.pages.page_categories, 'edit', response.data);
        Vue.set(App.pages.page_categories.edit, 'index', index);
        show_notification('success', response.message);
        refresh_selectpicker();
    }
</script>

@endpush

@section('content')


<script>
    App.pages.page_categories = {
        items: JSON.parse('{!! addslashes(mb_json_encode($categories)) !!}'),
        edit: {},
        path: '{!! route("shetabit.page-builder.categories.index") !!}'
    }
</script>


<div class="form-group">
    <button class="btn btn-primary" @click="openModal('new-page')">اضافه کردن</button>
</div>
<div class="row">
    <div class="col-md-6">
        <panel id="page_categories">
            <p slot="title">دسته‌بندی صفحات</p>
            <div slot="body">
                <select name="pages" id="pages" class="selectpicker" data-style="btn btn-white" title="انتخاب کنید" @change="showPageCategory">
                    <option :value="index" v-for="item,index in pages.page_categories.items">@{{ item.title }}</option>
                </select>
            </div>
        </panel>
    </div>
    <div class="col-md-6" v-if="!$.isEmptyObject(pages.page_categories.edit)">
        <panel id="edit-page">
            <p slot="title">@{{ pages.page_categories.edit.title }}</p>
            <div slot="body">
                <form :action="pages.page_categories.path + '/' + pages.page_categories.edit.id" method="post" class="js-submit-form" data-on-success="updatePageCategory">
                    <div class="form-group">
                        <label for="edit-title">عنوان</label>
                        <input id="edit-title" name="title" type="text" class="form-control" :value="pages.page_categories.edit.title" data-required>
                    </div>
                    <div class="pull-right">
                        <button class="btn btn-primary">ویرایش</button>
                        <button type="button" @click="deleteItem(pages.page_categories)" class="btn btn-danger">حذف</button>
                    </div>
                    <div class="clearfix"></div>
                    @csrf
                    @method('PUT')
                </form>
            </div>
        </panel>
    </div>
</div>


<modal id="new-page">
    <p slot="title">ثبت دسته‌بندی جدید</p>
    <div slot="body">
        <form :action="pages.page_categories.path" method="post" class="js-submit-form" data-on-success="newPageCategory" data-clear-onsuccess="true">
            <div class="form-group">
                <label for="title">عنوان</label>
                <input id="title" name="title" type="text" class="form-control" data-required>
            </div>
            @csrf
            <button class="btn btn-success">ثبت</button>
        </form>
    </div>
</modal>

@endsection