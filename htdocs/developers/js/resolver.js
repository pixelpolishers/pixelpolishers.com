(function() {
    var resultContainer;

    function handleSourceForgeLookup(data, textStatus, jqXHR) {
        console.log(data);
    }

    function handleGithubLookup(data, textStatus, jqXHR) {
        lookupPackage(data.name, function(result) {
            if (!result || result.packages[0].status === 404) {
                var name = $('<div />').html(data.name).text();
                var description = $('<div />').html(data.description).text();

                $('.package-row h3').html(name);
                $('.package-row p').html(description);

                $('.package-row').show();

                $('#resolver-lookup').hide();
                $('#resolver-submit').show();
            } else {
                $('#resolver-status').html('The package "' + data.name + '" already exists.');
            }
        });
    }

    function handlePackageResult(json) {
        var item;

        var url = '/resolver/package/' + json.fullname;
        var fullname = $('<div />').html(json.fullname).text();
        var description = $('<div />').html(json.description).text();

        item = '<div class="package-row">';
        item += '<h3><a href="' + url + '">' + fullname + '</a></h3>';
        item += '<p><a href="' + url + '">' + description + '</a></p>';
        item += '</div>';

        resultContainer.append(item);
    }

    function handleSearchResults(data, textStatus, jqXHR) {
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

    function lookupPackage(query, callback) {
        var url, parts = location.hostname.split('.');
        parts.shift();

        url = window.location.protocol + '//api.' + parts.join('.');
        $.getJSON(url + '/resolver/lookup?callback=?', {
            'q': query
        }, callback);
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

            if (val.length > 3) {
                clearTimeout(handle);

                resultContainer.empty();
                $('#result-loader').show();

                handle = setTimeout(function() {
                    searchForPackages(val);
                }, 500);
            }
        });

        function doSourceForgeLookup(repoUri) {
            var repoName = repoUri.pathname().replace(/^\/|\/$/g, '');

            if (repoName.substr(0, 2) === 'p/') {
                repoName = repoName.substring(2);
            } else if (repoName.substr(0, 9) === 'projects/') {
                repoName = repoName.substring(9);
            } else {
                $('#resolver-status').html('Please use the project url to submit your package.');
                $('#resolver-status').show();
                return;
            }

            $.ajax({
                url: 'https://sourceforge.net/api/project/name/' + repoName + '/json',
                type: 'GET',
                dataType: 'json',
                success: handleSourceForgeLookup,
                error: function(xhr) {
                    $('#resolver-status').html('The repository "' + repoName + '" could not be loaded. Are you sure the project exists?');
                    $('#resolver-status').show();
                }
            });
        }

        function doGithubLookup(repoUri) {
            var repoName = repoUri.pathname().substr(1);
            var url = 'https://api.github.com/repos/' + repoName;
            url += '/contents/resolver.json';

            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                success: handleGithubLookup,
                error: function(xhr) {
                    if (xhr.status === 403) {
                        $('#resolver-status').html('You do not seem to have access to the GitHub API: ' + xhr.responseJSON.message);
                    } else {
                        $('#resolver-status').html('The repository "' + repoName + '" could not be loaded. Are you sure there is a resolver.json file present?');
                    }
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
            //} else if (repoUri.subdomain() === 'code' && repoUri.domain() === 'google.com') {
            //    doGoogleCodeLookup(repoUri);
            //} else if (repoUri.domain() === 'sourceforge.net') {
            //    doSourceForgeLookup(repoUri);
            } else {
                $('#resolver-status').html('The service ' + repoUri.domain() + ' is not supported!');
                $('#resolver-status').show();
            }
            return false;
        });
    });
})();