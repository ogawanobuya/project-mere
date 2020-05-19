// send ajax request.
function ajaxGetJson() {
    let path = null;
    // var picker = null;
    // var modelId = null;
    let data = {};
    this.SetPath = function(argPath) {
        path = argPath;
    };
    this.SetPicker = function(argPicker) {
        data.start_date = argPicker.startDate.format('YYYY-MM-DD');
        data.end_date = argPicker.endDate.format('YYYY-MM-DD');
    };
    this.SetModelId = function(argModelId) {
        data.model_id = argModelId;
    };
    this.SetShopId = function(argShopId) {
        data.shop_id = argShopId;
    };
    this.Send = function() {
        let result = $.ajax({
            type: 'POST',
            url: path,
            dataType: 'json',
            data: data
        });
        return result;
    };
}
