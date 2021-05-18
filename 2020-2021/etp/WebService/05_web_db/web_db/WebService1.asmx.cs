using System.Data;               // da aggiungere 
using System.Data.SqlClient;     // da aggiungere 
using System.Web.Configuration;  // da aggiungere
using System.Web.Services;

namespace web_db
{
    /// <summary>
    /// Descrizione di riepilogo per WebService1
    /// </summary>
    [WebService(Namespace = "http://tempuri.org/")]
    [WebServiceBinding(ConformsTo = WsiProfiles.BasicProfile1_1)]
    [System.ComponentModel.ToolboxItem(false)]
    // Per consentire la chiamata di questo servizio Web dallo script utilizzando ASP.NET AJAX, rimuovere il commento dalla riga seguente. 
    // [System.Web.Script.Services.ScriptService]
    public class WebService1 : System.Web.Services.WebService
    {

        [WebMethod]
        //  interrogazione tabella anagrafica
        public DataSet InterrogaDB()
        {
            // Impostazione della stringa di connessione al database
            string conStr = WebConfigurationManager.ConnectionStrings["constr"].ConnectionString;
            DataTable dt = new DataTable();
            SqlDataReader dr = null;
            using (SqlConnection conn = new SqlConnection(conStr))
            {
                // Creazione della query di selezione
                string sql = string.Format(@"select id,Cognome,Nome from anagrafica");
                /*  altro modo di scrivere la query:
                    string sql = @"SELECT id,Cognome,Nome from anagrafica";  */
                /*  oppure, selezionando tutti i campi con * :
                    string sql = string.Format(@"select * from anagrafica");  */
                // Serie di comandi per creare la connessione al db
                SqlCommand cmd = new SqlCommand();
                cmd.Connection = conn;
                cmd.CommandText = sql;
                cmd.CommandType = CommandType.Text;
                conn.Open();
                // L'esecuzione carica i dati sul DataTable
                dr = cmd.ExecuteReader();
                dt.Load(dr);
                // Comandi di chiusura connessione
                conn.Close();
                cmd = null;
            }
            //Imposto i valori di ritorno del metodo (di tipo DataSet)
            DataSet dsReturn = new DataSet();
            dsReturn.Tables.Add(dt);
            return dsReturn;
        }


        [WebMethod]
        //  inserimento dati nella tabella anagrafica
        public int CaricaDB(int id, string cognome, string nome)
        {
            // Impostazione della stringa di connessione al database
            string conStr = WebConfigurationManager.ConnectionStrings["constr"].ConnectionString;
            int rowsInserted = 0;
            // Creating Sql Connection
            using (SqlConnection conn = new SqlConnection(conStr))
            {
                // Creazione del comando sql di inserimento
                string sql = string.Format(@"INSERT INTO anagrafica([id]," + @"[Cognome],[Nome])VALUES('" +
                id + "','" + cognome + "','" + nome + "')");
                // Serie di comandi per creare la connessione al db
                SqlCommand cmd = new SqlCommand();
                cmd.Connection = conn;
                cmd.CommandText = sql;
                cmd.CommandType = CommandType.Text;
                conn.Open();
                //L'esecuzione ritorna il numero di record coinvolti
                rowsInserted = cmd.ExecuteNonQuery();
                conn.Close();
                cmd = null;
            }
            return rowsInserted;
        }

        [WebMethod]
        public int EliminaDb(int id)
        {
            int successo = 0;

            // Impostazione della stringa di connessione al database
            string conStr = WebConfigurationManager.ConnectionStrings["constr"].ConnectionString;
            int rowsInserted = 0;
            // Creating Sql Connection
            using (SqlConnection conn = new SqlConnection(conStr))
            {
                string sql = string.Format(@"DELETE FROM anagrafica WHERE id =" + id);
                // Serie di comandi per creare la connessione al db
                SqlCommand cmd = new SqlCommand();
                cmd.Connection = conn;
                cmd.CommandText = sql;
                cmd.CommandType = CommandType.Text;
                conn.Open();
                //L'esecuzione ritorna il numero di record coinvolti
                successo = cmd.ExecuteNonQuery();
                conn.Close();
                cmd = null;
            }

            return successo;
        }

        [WebMethod]
        public int ModificaDb(int id, string nome, string cognome)
        {
            int successo = 0;

            // Impostazione della stringa di connessione al database
            string conStr = WebConfigurationManager.ConnectionStrings["constr"].ConnectionString;
            int rowsInserted = 0;
            // Creating Sql Connection
            using (SqlConnection conn = new SqlConnection(conStr))
            {
                string sql = string.Format(@"UPDATE anagrafica
                                            SET nome = '" + nome +"', cognome= '"+cognome+"' " +
                                            "WHERE id = " + id);
                // Serie di comandi per creare la connessione al db
                SqlCommand cmd = new SqlCommand();
                cmd.Connection = conn;
                cmd.CommandText = sql;
                cmd.CommandType = CommandType.Text;
                conn.Open();
                //L'esecuzione ritorna il numero di record coinvolti
                successo = cmd.ExecuteNonQuery();
                conn.Close();
                cmd = null;
            }

            return successo;
        }
    }
}
