/**
 * Created by wallace on 30/01/2015.
 */
angular.module("fluxo").directive('inputFileBase64', ['$rootScope', function ($rootScope) {
    return {
      restrict: 'A',
      link: function (scope, elem, attrs) {



        var imageInput = document.createElement('input');
        imageInput.setAttribute('type', 'file');
        if (attrs.multiple) {
          imageInput.setAttribute('multiple', '');
          scope.multiple=true;
        }

        if (attrs.accept) {
          imageInput.setAttribute('accept', attrs.accept);
        }

        imageInput.addEventListener('change', function () {

          var medias=[];
          var counter = imageInput.files.length;

          function loadImage(idx) {

            var fileName = imageInput.files[idx].name;

            var fileReader = new FileReader();

            fileReader.onload = function (fileLoadedEvent) {
              console.log(fileLoadedEvent.target);
              var srcData = fileLoadedEvent.target.result;

              function uint8ToString(buf) {
                var i, length, out = '';
                for (i = 0, length = buf.byteLength; i < length; i += 1) {
                  out += String.fromCharCode(buf[i]);
                }
                return out;
              }
              var base64 = btoa(uint8ToString(new Uint8Array(srcData)));

              medias.push({type: 'image',extension:fileName.substr(fileName.lastIndexOf('.') + 1), name: fileName, file: base64});

              if (++idx != counter) {
                loadImage(idx);
              } else {
                if(!scope.multiple && medias.length==1){
                  $rootScope.$broadcast('filesBase64',medias[0]);
                }else{
                  $rootScope.$broadcast('filesBase64',medias);
                }
                scope.$apply();
              }
            };

            // fileReader.readAsDataURL(imageInput.files[0]);
            fileReader.readAsArrayBuffer(imageInput.files[idx]);

          }

          loadImage(0);


        });


        $(elem).click(function () {
          imageInput.click();
        });

      }
    };
  }]);
