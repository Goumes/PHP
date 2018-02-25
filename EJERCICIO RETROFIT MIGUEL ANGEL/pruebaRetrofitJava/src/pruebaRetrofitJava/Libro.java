package pruebaRetrofitJava;

public class Libro {
	private int id;
	private String createdAt;
	private String updatedAt;
	private String titulo;
	private String numpag;

	
	public int getId() {
		return id;
	}
	public void setId(int id) {
		this.id = id;
	}
	public String getNumpag() {
		return numpag;
	}
	public void setNumpag(String numpag) {
		this.numpag = numpag;
	}
	public String getTitulo() {
		return titulo;
	}
	public void setTitulo(String titulo) {
		this.titulo = titulo;
	}
	public String getCreatedAt() {
		return createdAt;
	}
	public void setCreatedAt(String createdAt) {
		this.createdAt = createdAt;
	}
	public String getUpdatedAt() {
		return updatedAt;
	}
	public void setUpdatedAt(String updatedAt) {
		this.updatedAt = updatedAt;
	}
	
	

}
