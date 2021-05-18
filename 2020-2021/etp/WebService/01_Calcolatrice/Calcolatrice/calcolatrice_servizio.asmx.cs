using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Services;

namespace Calcolatrice
{
    /// <summary>
    /// Descrizione di riepilogo per calcolatrice_servizio
    /// </summary>
    [WebService(Namespace = "http://tempuri.org/")]
    [WebServiceBinding(ConformsTo = WsiProfiles.BasicProfile1_1)]
    [System.ComponentModel.ToolboxItem(false)]
    // Per consentire la chiamata di questo servizio Web dallo script utilizzando ASP.NET AJAX, rimuovere il commento dalla riga seguente. 
    // [System.Web.Script.Services.ScriptService]
    public class calcolatrice_servizio : System.Web.Services.WebService
    {


        [WebMethod]
        public double SommaNumeri(double Primo, double Secondo)
        {
            return Primo + Secondo;
        }

        [WebMethod]
        public double SottraiNumeri(double Primo, double Secondo)
        {
            return Primo - Secondo;
        }

        [WebMethod]
        public double MoltiplicaNumeri(double Primo, double Secondo)
        {
            return Primo * Secondo;
        }

        [WebMethod]
        public String DividiNumeri(double primo, double secondo)
        {
            return secondo == 0 ? "Il denominatore non può essere uguale a 0" :
                (primo / secondo).ToString();
        }

    }
}
