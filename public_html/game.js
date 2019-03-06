if (!Detector.webgl) Detector.addGetWebGLMessage();

this.container;
this.player = {};
this.stats;
this.controls;
this.camera;
this.scene;
this.renderer;

var stats, w, h, sphere, sphere1, togglecameraview, controller;

const gui = new dat.GUI();

this.container = document.createElement('div');
this.container.style.height = '100%';
document.body.appendChild(this.container);

this.clock = new THREE.Clock();


init();
animate();

window.onError = function (error) {
    console.error(JSON.stringify(error));
}

function init() {



    this.scene = new THREE.Scene();
    this.scene.background = new THREE.Color(0x000000);
    this.scene.fog = new THREE.Fog(0x000000, 200, 500);

    this.camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
    this.camera.position.set(0, window.innerWidth / 10, 190);
    this.camera.lookAt(this.scene.position);

    this.renderer = new THREE.WebGLRenderer({
        antialias: true
    });
    this.renderer.setPixelRatio(window.devicePixelRatio);
    this.renderer.setSize(window.innerWidth, window.innerHeight);
    this.renderer.shadowMap.enabled = true;

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
    var size1w = window.innerWidth / 5;
    var sizew = size1w || 10;
    var divisions = divisions1 || 10;
    var step = sizew / divisions;
    var halfSize = sizew / 2;

    var vertices = [];
    var scale = 1.77;
    var material1 = new THREE.LineBasicMaterial({
        color: 0xa0a0a0,
        opacity: 1,
        side: THREE.DoubleSide,
        lights: false
    });
    material1.transparent = true;
    var materialcylinder = new THREE.LineBasicMaterial({
        color: 0xfcdbff,
        opacity: 1,
        side: THREE.DoubleSide,
        lights: false
    });

    var meshlinematerial = new MeshLineMaterial({
        color: 0x993399
    });

    for (var i = 0, j = 0, k = -halfSize; i <= divisions; i++, k += step) {
        // vertices.push(-halfSize, 0, k, halfSize, 0, k);
        // vertices.push(k, 0, -halfSize, k, 0, halfSize);

        var v = new THREE.Vector3(+210 - halfSize - 1, 0.5, k * scale);
        var v0 = new THREE.Vector3(210 + halfSize + 1, 0.5, k * scale);
        var v1 = new THREE.Vector3(210 + k, 0.5, -halfSize * scale);
        var v2 = new THREE.Vector3(210 + k, 0.5, halfSize * scale);

        var geometry3 = new THREE.Geometry();

        var geometry4 = new THREE.Geometry();
        geometry3.vertices.push(v);
        geometry3.vertices.push(v0);
        geometry4.vertices.push(v1);
        geometry4.vertices.push(v2);

        var line = new MeshLine();
        line.setGeometry(geometry3, function (p) {
            return 2;
        });
        var mesh0 = new THREE.Mesh(line.geometry, meshlinematerial);
        this.scene.add(mesh0);


        var line2 = new MeshLine();
        line2.setGeometry(geometry4, function (p) {
            return 2;
        });
        var mesh1 = new THREE.Mesh(line2.geometry, meshlinematerial);
        this.scene.add(mesh1);

        for (var m = 0; m < divisions; m++) {
            if (i < divisions) {

                var mesh = new THREE.Mesh(new THREE.PlaneBufferGeometry(step, step * scale), material1);

                mesh.name = "mesh" + j;
                mesh.rotation.x = -Math.PI / 2;
                mesh.position.x = +210 + (halfSize - step / 2) + i * (-step);
                mesh.position.z = (halfSize - step / 2) * scale + m * (-step) * scale;

                mesh.receiveShadow = true;
                //mesh.material.color = new THREE.Color(Math.random()* 1/255, Math.random()* 1/255, Math.random()* 1/255);

                //mesh.geometry.colorsNeedUpdate = true;

                scene.add(mesh);
                j++;
            }
        }
    }

    // var geometry = new THREE.BufferGeometry();
    // geometry.addAttribute('position', new THREE.Float32BufferAttribute(vertices, 3));
    // geometry.addAttribute('color', new THREE.Float32BufferAttribute({
    //     color: 0x993399
    // }, 3));

    // var LineSegments = new THREE.LineSegments(geometry, meshlinematerial);
    // LineSegments.scale.set(1, 1, 1.77);
    // scene.add(LineSegments);

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
    outsideUniforms1.glowColor.value.set('hotpink');


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
    outsideUniforms.glowColor.value.set('hotpink');

    var axes = new THREE.AxisHelper(250);
    this.scene.add(axes);

    this.container.appendChild(this.renderer.domElement);

    this.controls = new THREE.OrbitControls(this.camera, this.renderer.domElement);
    this.controls.target.set(0, 150, 0);
    //this.controls.minPolarAngle = Math.PI / 2;
    this.controls.maxPolarAngle = Math.PI / 2 - 0.22;
    this.controls.minAzimuthAngle = Math.PI / 2;
    this.controls.maxAzimuthAngle = Math.PI / 2;
    //this.controls.mouseButtons.ORBIT = 0;
    this.controls.mouseButtons.PAN = 0;
    // if (this.controls.maxPolarAngle == Math.PI / 2) {
    //this.controls.enableZoom = false;
    this.controls.update();

    stats = new Stats();
    this.container.appendChild(stats.dom);



    var obj = {
        cameraX: camera.position.x,
        cameraY: camera.position.y,
        cameraZ: camera.position.z,
        cameraRotY: camera.rotation.z,

    }
    gui.remember(obj);

    //gui.add(controller, 'selected_cube').listen();
    var sphereX = gui.add(obj, 'cameraX').min(0).max(200).step(0.25);
    var sphereY = gui.add(obj, 'cameraY').min(0).max(200).step(0.25);
    var sphereZ = gui.add(obj, 'cameraZ').min(0).max(200).step(0.25);
    var camerarotY = gui.add(obj, 'cameraRotY').min(0).max(1).step(0.0001);


    sphereX.onChange(function (value) {
        camera.position.x = value;
        updateGui();
    });
    sphereY.onChange(function (value) {
        camera.position.y = value;
        updateGui();
    });
    sphereZ.onChange(function (value) {
        camera.position.z = value;
        updateGui();
    });
    camerarotY.onChange(function (value) {
        camera.rotation.y = value;
        updateGui();
    });


    //gui.add(rotationY, 'rotationY').listen();

    gui.open();


}

function updateGui() {
    for (var i in gui.__controllers) {
        gui.__controllers[i].updateDisplay();
    }
}

function onWindowResize() {
    this.camera.aspect = window.innerWidth / window.innerHeight;
    this.camera.updateProjectionMatrix();
    this.renderer.setSize(window.innerWidth, window.innerHeight);
}

function onDocumentMouseDown(event) {


    var raycaster = new THREE.Raycaster(); // create once
    var mouse = new THREE.Vector2(); // create once



    mouse.x = (event.clientX / renderer.domElement.clientWidth) * 2 - 1;
    mouse.y = -(event.clientY / renderer.domElement.clientHeight) * 2 + 1;

    raycaster.setFromCamera(mouse, camera);

    var intersects = raycaster.intersectObjects([sphere, sphere1]);



    if (intersects.length > 0) {

        var intersect = intersects[ 0 ].object.name;
        //alert(""+intersect);
        //alert('colidiu');
        //controller.selected_cube = selectedObject.name;
        // alert("camera rotation y: "+ camera.rotation.y + "\n" +
        // "camera position x: " + camera.position.x + "\n"+
        // "camera position y: " + camera.position.y + "\n"+
        // "camera position z: " + camera.position.z + "\n")

        // posx = 189.9
        // posy = 192.46
        // posz = 0
        // rotation z 1.35

        // x = 0, y = 344, z - 1.19


        togglecameraview = true;
        if (intersects[0].object.name === "bottonsphere") {
            bottonsphere = true;
        } else {
            bottonsphere = false;
        }
        // intersects[0].object.material.transparent = true;
        // intersects[0].object.material.opacity = 0.1;
        // intersects[0].object.material.color.set(0xff0000);
    }
}

function animate() {

    const dt = this.clock.getDelta();

    requestAnimationFrame(function () {
        animate();
    });



    window.addEventListener('resize', onWindowResize, false);
    document.addEventListener('mousedown', onDocumentMouseDown, false);
    //rotationY.rotationY = this.camera.rotation.y;

    if (togglecameraview) {
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
    updateGui();
    render();
    stats.update();
}

function render() {
    this.renderer.render(this.scene, this.camera);
}