<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
    <div id="form1">
      <p style="height: 267px;">
        <form action="#" method="POST"> 
          <label for="owner" class="label lowner">Owner:
            <select name="owner">
              <option>Ministerul Educatiei</option>
            </select>
          </label> <button name="Add_owner">Add</button><br />
          <label for="structure" class="label lstruc">Structure:
            <select name="structure">
              <option>Universitatea din Bucuresti</option>
              <option>Universitatea POLITEHNICA Bucuresti</option>
              <option>Universitatea Alexandru Ioan Cuza Iasi</option>
              <option>Universitatea Transilvania din Brasov</option>
            </select>
          </label> <button name="add_structure">Add</button>
          <fieldset> <legend>Descriere unit</legend> 
              
              <label for="unit_type" class="label lunit_type">Unit Type:
                <select name="unit_type">
                  <option>Facultate</option>
                  <option>Departament</option>
                  <option>Institut</option>
                </select>
              </label>
              <button name="add_unittype">Add</button><br />
              
              <label for="unit_domain" class="label lunit_domain">Unit Domain:
                <select name="unit_domain">
                  <option>Facultatea de Administraţie și Afaceri</option>
                  <option>Facultatea de Biologie</option>
                  <option>Facultatea de Chimie</option>
                </select>
              </label>
              <button name="add_unittype">Add</button><br />
              
              
              <label for="unit_name" class="label lunit_name">Unit
              Name:
              <select name="unit_name">
                <option>Ionescu de la Brad</option>
                <option>Facultatea de Biologie</option>
                <option>Facultatea de Chimie</option>
              </select>
            </label><button name="add_unitname">Add</button> <br />
            
            <label for="unit_location" class="label lunit_location">Unit
              Location:
              <select name="unit_location">
                <option>Municipiul Bucuresti</option>
                <option>Municipiul Iasi</option>
                <option>Municipiul Iasi</option>
              </select>
            </label><button name="add_unitdomain">Add</button> <br />
            <label for="site">Site: <input type="text" value="site" name="site" /><br />
            </label> <label for="site">Email: <input type="text" value="email"
                name="email" /><br />
            </label> <label for="datein">Date in: <input type="text" value="datein"
                name="datein" /><br />
            </label> <label for="dateout">Date in: <input type="text" value="dateout"
                name="dateout" /></label>
            <br />
            <label for="Obs">Observatii: <textarea name="Obs" cols="25" rows="5"></textarea></label><br />
          </fieldset>
        </form>
      </p>
    </div>