import { useForm } from "react-hook-form";
import { z } from "zod";
import { zodResolver } from "@hookform/resolvers/zod";
import { Link } from "react-router-dom";
import FormField from "../../../components/FormField";
import WhiteButton from "../../../components/WhiteButton";

const schema = z.object({
  email: z.string().email('Invalid email.'),
  password: z.string().min(1, "Field required."),
});

type loginSchema = z.infer<typeof schema>;

const Login = () => {
  const {
    register,
    handleSubmit,
    formState: { errors },
  } = useForm<loginSchema>({ resolver: zodResolver(schema) });

  function onSubmit({ email, password }) {
    console.log(email, password);
  }

  return (
    <div className="max-w-[300px] mx-auto">
      <h1 className="text-center text-2xl">Login</h1>

      <p className="my-4">
        Do not have an account?{" "}
        <Link to="/register" className="hover:text-slate-200">
          <u>Register now</u>
        </Link>
        .
      </p>

      <form onSubmit={handleSubmit(onSubmit)}>
        <FormField
          type="email"
          label="Email"
          name="email"
          register={register}
          error={errors.email}
        />
        <div className="mt-2">
          <FormField
            type="password"
            label="Password"
            name="password"
            register={register}
            error={errors.password}
          />
        </div>

        <WhiteButton value="Login" />
      </form>
    </div>
  );
};

export default Login;
