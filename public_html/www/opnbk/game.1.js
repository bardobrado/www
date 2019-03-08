class Game {

    constructor() {
        if (!Detector.webgl) Detector.addGetWebGLMessage();

        this.container;
        this.player = {};
        this.stats;
        this.controls;
        this.camera;
        this.scene;
        this.renderer;

        this.container = document.createElement('div');
        this.container.style.height = '100%';
        document.body.appendChild(this.container);

        const game = this;

        this.clock = new THREE.Clock();

        this.init();

        game.animate();
        game.onDocMouseDown();
        game.renderer();


        window.onError = function (error) {
            console.error(JSON.stringify(error));
        }
    }

    init() {



        this.scene = new THREE.Scene();
        this.scene.background = new THREE.Color(0x000000);
        this.scene.fog = new THREE.Fog(0x000000, 200, 500);


        this.camera = new THREE.PerspectiveCamera(70, window.innerWidth / window.innerHeight, 0.1, 1000);
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
            vertices.push(-halfSize, 0, k, halfSize, 0, k);
            vertices.push(k, 0, -halfSize, k, 0, halfSize);

            // var v = new THREE.Vector3(- halfSize-1   , 0.1, k * scale );
            // var v0 = new THREE.Vector3(  halfSize +1 , 0.1, k* scale );
            // var v1 = new THREE.Vector3(  k  , 0.1, -halfSize* scale  );
            // var v2 = new THREE.Vector3(   k  , 0.1,halfSize* scale );


            // var geometry3 = new THREE.Geometry();

            // var geometry4 = new THREE.Geometry();    
            // geometry3.vertices.push(v);
            // geometry3.vertices.push(v0);
            // geometry4.vertices.push(v1);
            // geometry4.vertices.push(v2);

            // var line = new MeshLine();
            // line.setGeometry (geometry3, function( p ) { return 2; });
            // var mesh0 = new THREE.Mesh(line.geometry, meshlinematerial);
            // this.scene.add(mesh0);

            // var line2 = new MeshLine();
            // line2.setGeometry (geometry4, function( p ) { return 2; });
            // var mesh1 = new THREE.Mesh(line2.geometry, meshlinematerial);
            // this.scene.add(mesh1);



            for (var m = 0; m < divisions; m++) {
                if (i < divisions) {

                    var mesh = new THREE.Mesh(new THREE.PlaneBufferGeometry(step, step * scale), material1);

                    mesh.name = "mesh" + j;
                    mesh.rotation.x = -Math.PI / 2;
                    mesh.position.x = (halfSize - step / 2) + i * (-step);
                    mesh.position.z = (halfSize - step / 2) * scale + m * (-step) * scale;
                    mesh.receiveShadow = true;
                    //mesh.material.color = new THREE.Color(Math.random()* 1/255, Math.random()* 1/255, Math.random()* 1/255);

                    //mesh.geometry.colorsNeedUpdate = true;

                    this.scene.add(mesh);
                    j++;
                }
            }
        }


        var geometry = new THREE.BufferGeometry();
        geometry.addAttribute('position', new THREE.Float32BufferAttribute(vertices, 3));
        geometry.addAttribute('color', new THREE.Float32BufferAttribute({
            color: 0x993399
        }, 3));




        var LineSegments = new THREE.LineSegments(geometry, meshlinematerial);
        LineSegments.scale.set(1, 1, 1.77);
        this.scene.add(LineSegments);


        //var geometry2 = new THREE.CylinderGeometry( 20, 20, 200, 32 );
        //        var geometry2 = new Cylinder2Geometry(1, 32, 16,1,1,1,1,30);

        var geometry2 = new THREE.SphereGeometry(10, 10, 10);
        var cylinder = new THREE.Mesh(geometry2, materialcylinder);
        this.scene.add(cylinder);

        cylinder.position.y = 130;
        var glowMesh = new THREEx.GeometricGlowMesh(cylinder, 0.001, 3);
        cylinder.add(glowMesh.object3d);
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
        this.controls.maxPolarAngle = Math.PI / 2;
        this.controls.minAzimuthAngle = Math.PI / 2;
        this.controls.maxAzimuthAngle = Math.PI / 2;
        //this.controls.mouseButtons.ORBIT = 0;
        this.controls.mouseButtons.PAN = 0;
        // if (this.controls.maxPolarAngle == Math.PI / 2) {
        //this.controls.enableZoom = false;
        // }

        this.controls.update();





    }



    animate() {
        const game = this;
        const dt = this.clock.getDelta();

        requestAnimationFrame(function () {
            game.animate();
        });

        // COLOCAR AQUI AS ANIMACOES
        window.addEventListener('resize', function () {
            game.onWindowResize();
        }, false);
        window.addEventListener('mousedown', function () {
            game.onDocMouseDown(window.event);
        }, false);
        // window.addEventListener('mousemove', onDocMouseMove());

        //render();
        //stats.update();
        this.renderer.render(this.scene, this.camera);



    }
    render(){
        this.renderer.render(this.scene, this.camera);
    }

    onWindowResize() {
        this.camera.aspect = window.innerWidth / window.innerHeight;
        this.camera.updateProjectionMatrix();

        this.renderer.setSize(window.innerWidth, window.innerHeight);

    }

    onDocMouseDown(event) {
        var xDoMouse = event.clientX;
        var yDoMouse = event.clientY;
        alert('hi');
        // converter x e y do mouse em coordenadas do mundo.
        // normalizar x e y do mouse

        xDoMouse = (xDoMouse / windows.innerWidth * 2) - 1;
        yDoMouse = -(yDoMouse / windows.innerHeight * 2) - 1;

        var vectorClick = new THREE.Vector3(xDoMouse, yDoMouse, 1);

        // converte de tela normalizada em coordenadas do mundo
        vectorClick = vectorClick.unprojectVector(vectorClick, this.camera);

        // raycasting: traça um raio de um ponto a outro verificando
        // se colide com algum objeto
        var raycaster = new THREE.Raycaster(this.camera.position, vectorClick.sub(this.camera.position).normalize());

        // chamar funcáo que teste se o raio colidiu com o objeto
        var intersects = raycaster.intersectsObjects([cylinder])

        // se o vetor nao for vazio houve intersecção entre o objeto e o mouse

        if (intersects.lenght > 0) {
            // houve uma colisão.

            // intersects[0] primeira colisao intersects[0].objects é o objeto
            intersects[0].object.material.transparent = true;
            intersects[0].object.material.opacity = 0.1;
            intersects[0].object.material.color.set(0xff0000);

        }
    }



}