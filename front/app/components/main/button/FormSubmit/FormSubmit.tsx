const FormSubmit = ({ txt }: { txt: string }) => {
      return (
        <button className="btn-form-submit" type="submit">
          <p>{txt}</p>
        </button>
      );
    };
    
    export default FormSubmit;
    