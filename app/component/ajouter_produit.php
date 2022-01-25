

<div class="content_dashboard">

      <div class="title">Admin / Ajouter un produit</div>
      <div class="errorPro"></div>

      <form action="" method="post" class="form-ajouter form-ajouterPro">
         <input type="text" name="actionAjouter" hidden value="ajouterProduct">
         <input type="text" name="nom" placeholder="nom" >
         <input type="number" step="any"  name="prix" placeholder="prix">
         <select name="category" id="">
            <option value="" selected disabled>Selectionner une Categorie</option>
            <option value="Tableau" >Tableau</option>
            <option value="Chaise" >Chaise</option>
            <option value="Lit"  >Lit</option>
            <option value="Porte" >Porte</option>
            <option value="Tiroir"  >Tiroir</option>
            <option value="Placard"  >Placard</option>
         </select>
         <textarea name="description" id="" placeholder="descritpion"></textarea>
         <input type="button" value="Télecharger image" id="btn-downloadImg">
         <input type="file" accept="image/*" name="image" hidden id="input-downloadImg">
         <input type="submit" id="btn-Ajouter" value="Ajouter">
         
      </form>

</div>
