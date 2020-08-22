$(function() {
    
    
    $("#RepoListGrid").jsGrid({
            width: "100%",
            height: "auto",
     
            heading: true,
            inserting: false,
            editing: false,
            sorting: true,
            paging: false,
            autoload: true,
     
            controller: {
                loadData: function(filter) {
                    return $.ajax({
                        type: "GET",
                        url: "api/github_repos/all",
                        data: filter
                    });
                },
            },
     
            fields: [
                { name: "id", title: "ID", type: "text", width: 20, sorting: true},
                { name: "repo_id", title: "Repository ID", type: "text", width: 20, sorting: true},
                { name: "name", title: "Name", type: "text", width: 30, sorting: true},
                { name: "repo_url", title: "Repository URL", width: 50, 
                         itemTemplate: function(value) {
                            return $("<a>").attr("href", value).text(value);
                         }
                },
                { name: "created_date", title: "Created Date", type: "text", width:20, sorting: true},
                { name: "last_push_date", title: "Last Push Date", type: "text", width:50, sorting: true},
                { name: "description", title: "Description", type: "text", width:20},
                { name: "num_of_stars", title: "No of Stars", type: "text", width:20, sorting: true},
            ]
        });


});


