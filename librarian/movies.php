<?php include('header.php'); ?>
<?php include('session.php'); ?>
<?php include('navbar_movies.php'); ?>
    <div class="container">
		<div class="margin-top">
			<div class="row">	
			<div class="span12">	
			   <div class="alert alert-info">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong><i class="icon-user icon-large"></i>&nbsp;Liste des Films</strong>
                                </div>
						<!--  -->
								    <ul class="nav nav-pills">
										<li   class="active"><a href="movies.php">All</a></li>
										<li><a href="new_movies.php">Nouveaux Films</a></li>
										<li><a href="old_movies.php">Ancien Films</a></li>
										<li><a href="lost.php">DVD perdu</a></li>
										<li><a href="damage.php">DVD Abimmé</a></li>
										<li><a href="sub_rep.php">DVD a remplacer</a></li>
									</ul>
						<!--  -->
						<center class="title">
						<h1>Liste des films</h1>
						</center>
                            <table cellpadding="0" cellspacing="0" border="0" class="table  table-bordered" id="example">
								<div class="pull-right">
								<a href="" onclick="window.print()" class="btn btn-info"><i class="icon-print icon-large"></i> Imprimer</a>
								</div>
								<p><a href="add_movies.php" class="btn btn-success"><i class="icon-plus"></i>&nbsp;Ajouter un film</a></p>
							
                                <thead>
                                    <tr>
									    <th>Acc No.</th>                                 
                                        <th>Nom du film</th>                                 
                                        <th>Categorie</th>
										<th>Autheur</th>
										<th class="action">exemplaires</th>
										<th>Film pub</th>
										<th>Producteur</th>
										<th>IMDB</th>
										<th>Année de sortie</th>
										<th>Date d'ajout</th>
										<th>Etat</th>
										<th class="action">Action</th>		
                                    </tr>
                                </thead>
                                <tbody>
								 
                                  <?php 

							
							
									

								  $user_query=mysql_query("select * from movie where status != 'Archive'")or die(mysql_error());
									while($row=mysql_fetch_array($user_query)){
									$id=$row['movie_id'];  
									$cat_id=$row['category_id'];
									$movie_copies = $row['movie_copies'];
									
									$borrow_details = mysql_query("select * from borrowdetails where movie_id = '$id' and borrow_status = 'pending'");
									$row11 = mysql_fetch_array($borrow_details);
									$count = mysql_num_rows($borrow_details);
									
									$total =  $movie_copies  -  $count; 
									/* $t4otal =  $book_copies  - $borrow_details;
									
									echo $total; */
											$cat_query = mysql_query("select * from category where category_id = '$cat_id'")or die(mysql_error());
											$cat_row = mysql_fetch_array($cat_query);
									?>
									<tr class="del<?php echo $id ?>">
                                    <td><?php echo $row['movie_id']; ?></td>
                                    <td><?php echo $row['movie_title']; ?></td>
									<td><?php echo $cat_row ['classname']; ?> </td>
                                    <td><?php echo $row['author']; ?> </td> 
                                    <td class="action"><?php echo /* $row['book_copies']; */   $total;   ?> </td>
                                     <td><?php echo $row['movie_pub']; ?></td>
									 <td><?php echo $row['publisher_name']; ?></td>
									 <td><?php echo $row['IMDB_Rating']; ?></td>
									 <td><?php echo $row['copyright_year']; ?></td>		
									 <td><?php echo $row['date_added']; ?></td>
									 <td><?php echo $row['status']; ?></td>
									<?php include('toolttip_edit_delete.php'); ?>
                                    <td class="action">
                                        <a rel="tooltip"  title="Supprimer" id="<?php echo $id; ?>" href="#delete_movie<?php echo $id; ?>" data-toggle="modal"    class="btn btn-danger"><i class="icon-trash icon-large"></i></a>
                                        <?php include('delete_movie_modal.php'); ?>
										<a  rel="tooltip"  title="Modifier" id="e<?php echo $id; ?>" href="edit_movie.php<?php echo '?id='.$id; ?>" class="btn btn-success"><i class="icon-pencil icon-large"></i></a>
										
                                    </td>
									
                                    </tr>
									<?php  }  ?>
                           
                                </tbody>
                            </table>
							
			
			</div>		
			</div>
		</div>
    </div>
<?php include('footer.php') ?>