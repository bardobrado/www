if (!Detector.webgl) Detector.addGetWebGLMessage();

this.container;
this.player = {};
this.stats;
this.controls;
this.camera;
this.scene;
this.renderer;
this.renderer2;
this.scene2;
this.element;

var stats, w, h, sphere, sphere1, togglecameraview, isMeshName, intersect;

//const gui = new dat.GUI();

this.container = document.createElement('div');
this.container.style.height = '100%';
this.container.style.width = '100%';
document.body.appendChild(this.container);

this.clock = new THREE.Clock();
var string = '<div>' +
'<h1>This is an H1 Element.</h1>' +
'<span class="large">Hello Essential Three.js</span>' +
'  <button type="button">Click Me!</button> ' +

'<textarea> And this is a textarea</textarea>' +
'</div>';

var string2 ="https://crazynessmyths.blogspot.com/";

init();
animate();

window.onError = function (error) {
    console.error(JSON.stringify(error));
}

function init() {

    var grid = [];
    grid.push(3);
    grid.push(5);
    //alert(grid);

    this.scene = new THREE.Scene();
    this.scene.background = new THREE.Color(0xd3dce5);
    this.scene.fog = new THREE.Fog(0xFFFFFF, 200, 500);



    this.renderer = new THREE.WebGLRenderer({
        antialias: true
    });
    this.renderer.setPixelRatio(window.devicePixelRatio);
    this.renderer.setSize(window.innerWidth, window.innerHeight);
    this.renderer.shadowMap.enabled = true;

    this.scene2 = new THREE.Scene();
     //HTML
     this.element = document.createElement('div');
     //element.innerHTML = string;
     this.element.className = 'animated bounceInDown' ; 
     this.element.style.background = "#0094ff";
     this.element.style.fontSize = "2em";
     this.element.style.color = "white";
     this.element.style.padding = "2em";

     //CSS Object
     this.div = createCSS3DObject(string2);
     this.div.position.x = -200;
     this.div.position.y = 130;
     this.div.position.z = 0;
     this.div.rotation.y = Math.PI/2;
     
     this.scene2.add(div);

     //CSS3D Renderer
     this.renderer2 = new THREE.CSS3DRenderer();
     this.renderer2.setSize(window.innerWidth, window.innerHeight);
     this.renderer2.domElement.style.position = 'absolute';
     this.renderer2.domElement.style.top = 0;
     
     //document.body.appendChild(renderer2.domElement);
     this.container.appendChild(this.renderer.domElement);
     this.container.appendChild(this.renderer2.domElement);
    


    this.camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
    this.camera.position.set(0, 108, 190);
    this.camera.lookAt(this.scene.position);

    let light = new THREE.HemisphereLight(0xffffff, 0x444444);
    light.position.set(0, 200, 0);
    this.scene.add(light);

    light = new THREE.DirectionalLight(0xffffff);
    light.position.set(0, 200, 100);
    light.castShadow = true;
    light.shadow.camera.top = 180;
    light.shadow.camera.bottom = -100;
    light.shadow.camera.left = -120;
    light.shadow.camera.right = 120;
    this.scene.add(light);

    //grid
    var divisions1 = 5;
    var size1w = 380;
    var sizew = size1w || 10;
    var divisions = divisions1 || 10;
    var step = sizew / divisions;
    var halfSize = sizew / 2;

    var vertices = [];
    // var scale = window.innerWidth/window.innerHeight;
    var scale = 1.77;

    var material1 = new THREE.LineBasicMaterial({
        color: 0xa0a0a0,
        opacity: 0.5,
        side: THREE.DoubleSide,
        lights: false,

    });
    material1.transparent = true;
    var materialcylinder = new THREE.LineBasicMaterial({
        color: 0xFFFFFF,
        opacity: 1,
        side: THREE.DoubleSide,
        lights: false
    });

    var meshlinematerial = new MeshLineMaterial({
        color: 0xFFFFFF,
        opacity: 0.3
    });
    meshlinematerial.transparent = true;
    var valor = Math.max.apply(null, grid );
    for (var i = 0, j = 0, k = -halfSize; i <= Math.max.apply(null, grid) ; i++, k += step) {
  
            
            var v = new THREE.Vector3(( 210- halfSize - 1), 0.5, k * scale);
            var v0 = new THREE.Vector3((58 + halfSize + 1), 0.5, k * scale);
            var geometry3 = new THREE.Geometry();
            geometry3.vertices.push(v);
            geometry3.vertices.push(v0);

            var line = new MeshLine();
            line.setGeometry(geometry3, function (p) {
                return 2;
            });
            var mesh0 = new THREE.Mesh(line.geometry, meshlinematerial);
            this.scene.add(mesh0);

            if ( i > 1) {
                //alert(i)
            var v1 = new THREE.Vector3(58 + k , 0.5, halfSize * scale);
            var v2 = new THREE.Vector3(58 + k, 0.5, -halfSize * scale);
            var geometry4 = new THREE.Geometry();
            geometry4.vertices.push(v1);
            geometry4.vertices.push(v2);

            var line2 = new MeshLine();
            line2.setGeometry(geometry4, function (p) {
                return 2;
            });
            var mesh1 = new THREE.Mesh(line2.geometry, meshlinematerial);
            this.scene.add(mesh1);
       

            for (var m = 0; m < divisions; m++) {
                if (i < divisions) {

                    var mesh = new THREE.Mesh(new THREE.PlaneBufferGeometry(step, step * scale), material1);

                    mesh.name = "tela" + j;
                    mesh.rotation.x = -Math.PI / 2;
                    mesh.position.x = +210 + (halfSize - step / 2) + i * (-step);
                    mesh.position.z = (halfSize - step / 2) * scale + m * (-step) * scale;

                    mesh.receiveShadow = true;
                  

                    scene.add(mesh);
                    j++;
                }
            }
        }
    }

 

    var geometry1 = new THREE.SphereGeometry(1, 1, 1);
    sphere1 = new THREE.Mesh(geometry1, materialcylinder);
    sphere1.name = "topsphere";

    this.scene.add(sphere1);
    sphere1.position.x = 8;
    sphere1.position.y = 335;
    sphere1.position.z = 0;

    var glowMesh1 = new THREEx.GeometricGlowMesh(sphere1, 0.001, 1);
    sphere1.add(glowMesh1.object3d);
    var insideUniforms1 = glowMesh1.insideMesh.material.uniforms;
    insideUniforms1.glowColor.value.set('hotpink');
    var outsideUniforms1 = glowMesh1.outsideMesh.material.uniforms;
    outsideUniforms1.glowColor.value.set(0xf0f0f0);


    var geometry2 = new THREE.SphereGeometry(1, 1, 1);
    sphere = new THREE.Mesh(geometry2, materialcylinder);
    sphere.name = "bottonsphere";
    this.scene.add(sphere);
    sphere.position.x = 184;
    sphere.position.y = 185;
    sphere.position.z = 0;

    var glowMesh = new THREEx.GeometricGlowMesh(sphere, 0.001, 1);
    sphere.add(glowMesh.object3d);
    var insideUniforms = glowMesh.insideMesh.material.uniforms;
    insideUniforms.glowColor.value.set('hotpink');
    var outsideUniforms = glowMesh.outsideMesh.material.uniforms;
    outsideUniforms.glowColor.value.set(0xf0f0f0);


    

    var controls = new THREE.OrbitControls(this.camera, this.renderer.domElement);
    controls.target.set(0, 150, 0);
    //this.controls.minPolarAngle = Math.PI / 2;
    controls.maxPolarAngle = Math.PI / 2 - 0.22;
    controls.minAzimuthAngle = Math.PI / 2;
    //this.controls.maxAzimuthAngle = Math.PI / 2;
    //this.controls.mouseButtons.ORBIT = 0;
    //this.controls.mouseButtons.PAN = 0;
    // if (this.controls.maxPolarAngle == Math.PI / 2) {
    //this.controls.enableZoom = false;
    //this.controls.enabled = false;
    controls.update();

  
    


}

function createCSS3DObject(s) {
    // create outerdiv and set inner HTML from supplied string
    var iframe = document.createElement('iframe');
    //div.innerHTML = s;
    // set some values on the div to style it, standard CSS
    //div.style.width = div.contentWindow.document.body.scrollWidth + 'px';
    iframe.style.width = window.innerWidth / 1.777;
    iframe.style.height = window.innerHeight /2;
    iframe.style.opacity = 0.7;
    iframe.target = "_self";
    //div.style.background = new THREE.Color(Math.random() * 0xffffff).getStyle();
    // create a CSS3Dobject and return it.
    iframe.src = s;
    
    var object = new THREE.CSS3DObject(iframe);
    return object;
}


function onWindowResize() {
    this.camera.aspect = window.innerWidth / window.innerHeight;
    this.camera.updateProjectionMatrix();
    this.renderer.setSize(window.innerWidth, window.innerHeight);

    this.composer = new THREE.EffectComposer(this.renderer);

    if (instance.renderer)
        instance.renderer.setSize(instance.dom.clientWidth, instance.dom.clientHeight);
    if (instance.composer)
        instance.composer.setSize(instance.dom.clientWidth, instance.dom.clientHeight);
}




function onDocumentTouchEnd(event) {
    event.preventDefault();

    mouse.x = (event.changedTouches[0].PageX / window.innerWidth) * 2 - 1;
    mouse.y = -(event.changedTouches[0].PageY / window.innerHeight) * 2 + 1;

    raycaster.setFromCamera(mouse, camera);
    var intersects = raycaster.intersectObjects(scene.children);

    if (intersects.length > 0) {

        togglecameraview = true;

        //alert(intersects[0].object.name);
        intersect = intersects[0].object.name;
        isMeshName = intersect.includes("tela");
      



        if (!isMeshName) {
            if (intersects[0].object.name === "bottonsphere") {
                bottonsphere = true;
            } else {
                bottonsphere = false;
            }
           
        } else {
            intersects[0].material.color = new THREE.Color(0x000000);
        }
    }
}

function onDocumentMouseDown(event) {


    var raycaster = new THREE.Raycaster(); // create once
    var mouse = new THREE.Vector2(); // create once


  
    mouse.x = (event.clientX / renderer.domElement.clientWidth) * 2 - 1;
    mouse.y = -(event.clientY / renderer.domElement.clientHeight) * 2 + 1;


    raycaster.setFromCamera(mouse, camera);

    var intersects = raycaster.intersectObjects(scene.children);



    if (intersects.length > 0) {

        togglecameraview = true;

        //alert(intersects[0].object.name);
        intersect = intersects[0].object.name;
        isMeshName = intersect.includes("tela");
      



        if (!isMeshName) {
            if (intersects[0].object.name === "bottonsphere") {
                bottonsphere = true;
            } else {
                bottonsphere = false;
            }
           
        } else {
            intersects[0].material.color = new THREE.Color(0x000000);
        }
    }
}

function animate() {

    const dt = this.clock.getDelta();

    requestAnimationFrame(function () {
        animate();
    });



    window.addEventListener('resize', onWindowResize, false);
    document.addEventListener('mousedown', onDocumentMouseDown, false);
    document.addEventListener('touchend', onDocumentTouchEnd, false);
    //rotationY.rotationY = this.camera.rotation.y;

    if (togglecameraview) {
        if (!isMeshName) {
            if (!bottonsphere) {
                this.camera.rotation.y += 0.06;

                this.camera.position.x -= 30;
                this.camera.position.y -= 10;


                if (this.camera.position.y <= 192.46) {
                    this.camera.position.y = 192.46;
                }
                if (this.camera.position.x <= 189.9) {
                    this.camera.position.x = 189.9;
                }

                if (this.camera.rotation.y > 1.34) {
                    this.camera.rotation.y = 1.34;
                    togglecameraview = false;
                }

            } else {

                this.camera.rotation.y -= 0.06;

                this.camera.position.x -= 10;
                this.camera.position.y += 40;


                if (this.camera.position.y >= 344) {
                    this.camera.position.y = 344;
                }
                if (this.camera.position.x <= 0) {
                    this.camera.position.x = 0;
                }

                if (this.camera.rotation.y < 0.01) {
                    togglecameraview = false;
                }


            }
        }
    }
    //this.controls.update();
    render();
   
}

function render() {
    
    this.renderer.render(this.scene, this.camera);
    this.renderer2.render(this.scene2, camera);
    
}