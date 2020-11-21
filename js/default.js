
var postApp = angular.module("postApp", []);

postApp.controller('postController',
    function postController($scope, $http){
//        $scope.hide = true;
        function getPosts(){
        $http({metod: 'GET', url: 'default/get_comments?topic=test'}).
            then(function success(response){
                $scope.posts = response["data"];
            });
        }
        getPosts();
        
        setInterval(getPosts, 30000);
    }
)

postApp.controller('commController',
    function commController($scope, $http){
        $scope.count = 0;
        $scope.hide = true;
        $scope.text = "";
        $scope.id;
        $scope.parentId;
        $scope.save = function(e){
            var xsrf = $.param({body:this.text, parent_id:this.id, topic_id:'test'});
            $http({
                url: 'default/save_comments',
                method: "POST",
                data: xsrf,
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function success(response){
                
            });
        }
    }
)