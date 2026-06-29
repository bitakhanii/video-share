<form class="mt-5" action="#" method="get">

    <div class="row">
        <div class="form-group col-md-3">
            <label for="inputCity">ترتیب بر اساس</label>
            <select class="form-control" name="sortBy">
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
            <label for="inputState">مدت زمان</label>
            <select id="inputState" class="form-control" name="length">
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

            <div class="form-group col-md-3" style="margin-top: 29px;">
                <button type="submit" class="btn btn-primary">فیلتر</button>
            </div>
        </div>
    </form>
