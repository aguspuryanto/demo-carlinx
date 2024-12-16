
    var requestOptions = {
      method: 'GET',
    };

    $('#lokasiJemput').on('change', function () {
      var textAddress = $(this).val();
      fetch("https://api.geoapify.com/v1/geocode/autocomplete?text=" + textAddress + "&apiKey=b13dfbfe7b934de88fdf373de1f1c1c9", requestOptions)
        .then(response => response.json())
        .then(function (result) {
          console.log(result);
        })
        .catch(error => console.log('error', error));
    });