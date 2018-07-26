<?php

use Illuminate\Database\Seeder;

class EjerciciosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ejercicio')->insert([
            'id' => 1,
            'nombre' => 'Front Squat',
            'descripcion' => 'Ejercicio para fortalecer las piernas ',
            'instrucciones' => ' Este ejercicio se realiza mejor dentro de una rejilla de sentadillas por razones de seguridad. Para comenzar, primero configure la barra en un bastidor que mejor se adapte a su altura. Una vez que se elige la altura correcta y la barra está cargada, suba los brazos por debajo de la barra mientras mantiene los codos altos y el brazo superior ligeramente por encima del paralelo al piso. Apoye la barra encima de los deltoides y cruce los brazos mientras agarra la barra para un control total.
            Levanta la barra del estante empujando primero con las piernas y al mismo tiempo estirando el torso.
            Aléjese de la rejilla y coloque las piernas usando una posición media de ancho de hombros con los dedos del pie ligeramente señalados. Mantén la cabeza en alto en todo momento, ya que mirar hacia abajo te hará perder el equilibrio y también mantendrá la espalda recta. Esta será su posición inicial. (Nota: para los propósitos de esta discusión usaremos la postura media descrita anteriormente que apunta al desarrollo general, sin embargo, puede elegir cualquiera de las tres posturas descritas en la sección de posicionamiento del pie).
            Comience a bajar lentamente la barra doblando las rodillas mientras mantiene una postura recta con la cabeza erguida. Continúe hacia abajo hasta que el ángulo entre la parte superior de la pierna y las pantorrillas sea ligeramente inferior a 90 grados (que es el punto en el cual las piernas superiores están debajo de la paralela al piso). Inhale mientras realiza esta parte del movimiento. Consejo: si realizó el ejercicio correctamente, la parte delantera de las rodillas debe formar una línea recta imaginaria con los dedos de los pies perpendiculares al frente. Si sus rodillas están más allá de esa línea imaginaria (si están más allá de los dedos de los pies), está ejerciendo una presión excesiva sobre la rodilla y el ejercicio se realizó de forma incorrecta.
            Comienza a elevar la barra mientras exhalas empujando el piso principalmente con la mitad de tu pie mientras enderezas las piernas nuevamente y vuelves a la posición inicial.
            Repita para la cantidad recomendada de repeticiones.
            ',
            'img' => '',
            'video' => '',
            'id_tipo_ejercicio' => 2
        ]);

        DB::table('ejercicio')->insert([
            'id' => 2,
            'nombre' => 'OverHead Squat',
            'descripcion' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'instrucciones' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus fringilla scelerisque ullamcorper. Nunc id dapibus leo, eu hendrerit metus. Proin et dolor vulputate, eleifend ligula quis, tempus diam. Cras congue, orci nec varius consectetur, urna magna convallis ipsum, sit amet dictum arcu mauris et nisl. Fusce eu hendrerit ligula. Curabitur maximus molestie est, id tempus leo consequat sed. Vestibulum nec efficitur eros, sed lacinia leo.',
            'img' => '',
            'video' => '',
            'id_tipo_ejercicio' => 2
        ]);

        DB::table('ejercicio')->insert([
            'id' => 3,
            'nombre' => 'Shoulder Press',
            'descripcion' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'instrucciones' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus fringilla scelerisque ullamcorper. Nunc id dapibus leo, eu hendrerit metus. Proin et dolor vulputate, eleifend ligula quis, tempus diam. Cras congue, orci nec varius consectetur, urna magna convallis ipsum, sit amet dictum arcu mauris et nisl. Fusce eu hendrerit ligula. Curabitur maximus molestie est, id tempus leo consequat sed. Vestibulum nec efficitur eros, sed lacinia leo.',
            'img' => '',
            'video' => '',
            'id_tipo_ejercicio' => 2
        ]);

        DB::table('ejercicio')->insert([
            'id' => 4,
            'nombre' => 'Push Press',
            'descripcion' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. ',
            'instrucciones' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus fringilla scelerisque ullamcorper. Nunc id dapibus leo, eu hendrerit metus. Proin et dolor vulputate, eleifend ligula quis, tempus diam. Cras congue, orci nec varius consectetur, urna magna convallis ipsum, sit amet dictum arcu mauris et nisl. Fusce eu hendrerit ligula. Curabitur maximus molestie est, id tempus leo consequat sed. Vestibulum nec efficitur eros, sed lacinia leo.',
            'img' => '',
            'video' => '',
            'id_tipo_ejercicio' => 2
        ]);

        DB::table('ejercicio')->insert([
            'id' => 5,
            'nombre' => 'Push Jerk',
            'descripcion' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. ',
            'instrucciones' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus fringilla scelerisque ullamcorper. Nunc id dapibus leo, eu hendrerit metus. Proin et dolor vulputate, eleifend ligula quis, tempus diam. Cras congue, orci nec varius consectetur, urna magna convallis ipsum, sit amet dictum arcu mauris et nisl. Fusce eu hendrerit ligula. Curabitur maximus molestie est, id tempus leo consequat sed. Vestibulum nec efficitur eros, sed lacinia leo.',
            'img' => '',
            'video' => '',
            'id_tipo_ejercicio' => 2
        ]);

        DB::table('ejercicio')->insert([
            'id' => 6,
            'nombre' => 'Deadlift',
            'descripcion' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. ',
            'instrucciones' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus fringilla scelerisque ullamcorper. Nunc id dapibus leo, eu hendrerit metus. Proin et dolor vulputate, eleifend ligula quis, tempus diam. Cras congue, orci nec varius consectetur, urna magna convallis ipsum, sit amet dictum arcu mauris et nisl. Fusce eu hendrerit ligula. Curabitur maximus molestie est, id tempus leo consequat sed. Vestibulum nec efficitur eros, sed lacinia leo.',
            'img' => '',
            'video' => '',
            'id_tipo_ejercicio' => 2
        ]);

        DB::table('ejercicio')->insert([
            'id' => 7,
            'nombre' => 'Medicine-Ball Clean',
            'descripcion' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. ',
            'instrucciones' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus fringilla scelerisque ullamcorper. Nunc id dapibus leo, eu hendrerit metus. Proin et dolor vulputate, eleifend ligula quis, tempus diam. Cras congue, orci nec varius consectetur, urna magna convallis ipsum, sit amet dictum arcu mauris et nisl. Fusce eu hendrerit ligula. Curabitur maximus molestie est, id tempus leo consequat sed. Vestibulum nec efficitur eros, sed lacinia leo.',
            'img' => '',
            'video' => '',
            'id_tipo_ejercicio' => 2
        ]);

        DB::table('ejercicio')->insert([
            'id' => 8,
            'nombre' => 'Sumo Deadlift High Pull',
            'descripcion' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. ',
            'instrucciones' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus fringilla scelerisque ullamcorper. Nunc id dapibus leo, eu hendrerit metus. Proin et dolor vulputate, eleifend ligula quis, tempus diam. Cras congue, orci nec varius consectetur, urna magna convallis ipsum, sit amet dictum arcu mauris et nisl. Fusce eu hendrerit ligula. Curabitur maximus molestie est, id tempus leo consequat sed. Vestibulum nec efficitur eros, sed lacinia leo.',
            'img' => '',
            'video' => '',
            'id_tipo_ejercicio' => 2
        ]);
        
    }
}
