﻿//------------------------------------------------------------------------------
// <auto-generated>
//     Il codice è stato generato da uno strumento.
//     Versione runtime:4.0.30319.42000
//
//     Le modifiche apportate a questo file possono provocare un comportamento non corretto e andranno perse se
//     il codice viene rigenerato.
// </auto-generated>
//------------------------------------------------------------------------------

namespace web_db_consumer.ServiceReference1 {
    using System.Data;
    
    
    [System.CodeDom.Compiler.GeneratedCodeAttribute("System.ServiceModel", "4.0.0.0")]
    [System.ServiceModel.ServiceContractAttribute(ConfigurationName="ServiceReference1.WebService1Soap")]
    public interface WebService1Soap {
        
        [System.ServiceModel.OperationContractAttribute(Action="http://tempuri.org/InterrogaDB", ReplyAction="*")]
        [System.ServiceModel.XmlSerializerFormatAttribute(SupportFaults=true)]
        System.Data.DataSet InterrogaDB();
        
        [System.ServiceModel.OperationContractAttribute(Action="http://tempuri.org/InterrogaDB", ReplyAction="*")]
        System.Threading.Tasks.Task<System.Data.DataSet> InterrogaDBAsync();
        
        [System.ServiceModel.OperationContractAttribute(Action="http://tempuri.org/CaricaDB", ReplyAction="*")]
        [System.ServiceModel.XmlSerializerFormatAttribute(SupportFaults=true)]
        int CaricaDB(int id, string cognome, string nome);
        
        [System.ServiceModel.OperationContractAttribute(Action="http://tempuri.org/CaricaDB", ReplyAction="*")]
        System.Threading.Tasks.Task<int> CaricaDBAsync(int id, string cognome, string nome);
    }
    
    [System.CodeDom.Compiler.GeneratedCodeAttribute("System.ServiceModel", "4.0.0.0")]
    public interface WebService1SoapChannel : web_db_consumer.ServiceReference1.WebService1Soap, System.ServiceModel.IClientChannel {
    }
    
    [System.Diagnostics.DebuggerStepThroughAttribute()]
    [System.CodeDom.Compiler.GeneratedCodeAttribute("System.ServiceModel", "4.0.0.0")]
    public partial class WebService1SoapClient : System.ServiceModel.ClientBase<web_db_consumer.ServiceReference1.WebService1Soap>, web_db_consumer.ServiceReference1.WebService1Soap {
        
        public WebService1SoapClient() {
        }
        
        public WebService1SoapClient(string endpointConfigurationName) : 
                base(endpointConfigurationName) {
        }
        
        public WebService1SoapClient(string endpointConfigurationName, string remoteAddress) : 
                base(endpointConfigurationName, remoteAddress) {
        }
        
        public WebService1SoapClient(string endpointConfigurationName, System.ServiceModel.EndpointAddress remoteAddress) : 
                base(endpointConfigurationName, remoteAddress) {
        }
        
        public WebService1SoapClient(System.ServiceModel.Channels.Binding binding, System.ServiceModel.EndpointAddress remoteAddress) : 
                base(binding, remoteAddress) {
        }
        
        public System.Data.DataSet InterrogaDB() {
            return base.Channel.InterrogaDB();
        }
        
        public System.Threading.Tasks.Task<System.Data.DataSet> InterrogaDBAsync() {
            return base.Channel.InterrogaDBAsync();
        }
        
        public int CaricaDB(int id, string cognome, string nome) {
            return base.Channel.CaricaDB(id, cognome, nome);
        }
        
        public System.Threading.Tasks.Task<int> CaricaDBAsync(int id, string cognome, string nome) {
            return base.Channel.CaricaDBAsync(id, cognome, nome);
        }
    }
}
