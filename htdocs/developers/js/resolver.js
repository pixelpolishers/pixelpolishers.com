(function() {
    var resultContainer;

    function handleLookup(data, textStatus, jqXHR) {
        $('.package-row h3').html(data.name);
        $('.package-row p').html(data.description);

        $('.package-row').show();

        $('#resolver-lookup').hide();
        $('#resolver-submit').show();
    }

    function handlePackageResult(json) {
        var item;

        var url = '/resolver/package/' + json.fullname;

        item = '<div class="package-row">';
        item += '<h3><a href="' + url + '">' + json.fullname + '</a></h3>';
        item += '<p><a href="' + url + '">' + json.description + '</a></p>';
        item += '</div>';

        resultContainer.append(item);
    }

    function handleSearchResults(data, textStatus, jqXHR) {
        var foundPackage = false;

        $('#result-loader').hide();
        resultContainer.empty();

        if (data.packages.length === 0) {
            resultContainer.append('<p>No packages found...</p>');
        } else {
            for (var i = 0; i < data.packages.length; ++i) {
                handlePackageResult(data.packages[i]);
            }
        }
    }

    function searchForPackages(query) {
        var url, parts = location.hostname.split('.');
        parts.shift();

        url = window.location.protocol + '//api.' + parts.join('.');
        $.getJSON(url + '/resolver/search?callback=?', {
            'q': query
        }, handleSearchResults);
    }

    $(document).ready(function() {
        var handle;

        resultContainer = $('#result-overview');

        $('#resolver-query').keyup(function() {
            var val = $(this).val();

            if (val !== '') {
                clearTimeout(handle);

                resultContainer.empty();
                $('#result-loader').show();

                handle = setTimeout(function() {
                    searchForPackages(val);
                }, 500);
            }
        });

        function doGithubLookup(repoUri) {
            var repoName = repoUri.pathname().substr(1);
            var url = 'https://api.github.com/repos/' + repoName;
            url += '/contents/resolver.json';

            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                success: handleLookup,
                error: function() {
                    $('#resolver-status').html('The repository "' + repoName + '" could not be loaded. Are you sure there is a resolver.json file present?');
                    $('#resolver-status').show();
                },
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('Accept', 'application/vnd.github.3.raw');
                }
            });
        }

        $('#resolver-url').keyup(function() {
            $('#resolver-status').hide();

            $('.package-row').hide();
            $('#resolver-lookup').show();
            $('#resolver-submit').hide();
        });

        $('#resolver-lookup').click(function() {
            var repoUri = URI($('#resolver-url').val());

            if (repoUri.domain() === 'github.com') {
                doGithubLookup(repoUri);
            } else {
                $('#resolver-status').html('The service ' + repoUri.domain() + ' is not supported!');
                $('#resolver-status').show();
            }
            return false;
        });
    });
})();