<form class="mt-4 p-3 bg-light rounded-3 border" action="#" method="get">

    <div class="row g-3 align-items-end">
        <div class="form-group col-md-3">
            <label for="inputCity" class="form-label">ترتیب بر اساس</label>
            <select class="form-select" name="sortBy">
                <option
                    value="created_at" {{ $sortByQuery == 'created_at' ? 'selected' : '' }}>
                    جدیدترین
                </option>
                <option value="like" {{ $sortByQuery == 'like' ? 'selected' : '' }}>
                    محبوب‌‌ترین
                </option>
                <option
                    value="length" {{ $sortByQuery == 'length' ? 'selected' : '' }}>
                    مدت زمان ویدئو
                </option>
            </select>
        </div>

        <div class="form-group col-md-3">
            <label for="inputState" class="form-label">مدت زمان</label>
            <select id="inputState" class="form-select" name="length">
                <option value="" {{ $lengthQuery == null ? 'selected' : '' }}>همه
                </option>
                <option value="1" {{ $lengthQuery == 1 ? 'selected' : '' }}>کمتر از ۱۰
                    دقیقه
                </option>
                <option value="2" {{ $lengthQuery == 2 ? 'selected' : '' }}>۱۰ تا ۳۰
                    دقیقه
                </option>
                <option value="3" {{ $lengthQuery == 3 ? 'selected' : '' }}>بیشتر از
                    ۳۰ دقیقه
                </option>
            </select>
        </div>

        <input type="hidden" name="q" value="{{ request()->query('q') }}">

        <div class="form-group col-md-3">
            <button type="submit" class="btn btn-danger w-100">فیلتر</button>
        </div>
    </div>
</form>
