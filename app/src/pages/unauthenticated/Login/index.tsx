import { useForm } from "react-hook-form";
import { z } from "zod";
import { zodResolver } from "@hookform/resolvers/zod";

const schema = z.object({
  email: z.string().email(),
  password: z.string().min(1),
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
      <h1 className="text-center text-2xl">Login page</h1>

      <p className="my-4">
        Already have an account? <u>Login in</u>.
      </p>

      <form onSubmit={handleSubmit(onSubmit)}>
        <label>Email*</label>
        <input
          type="text"
          className="text-black p-1 w-full rounded"
          {...register("email")}
        />
        {errors.email && (
          <p className="mt-0.5 text-[#ff4e4e]">Email not valid.</p>
        )}

        <label className="mt-2 block">Password*</label>
        <input
          type="password"
          className="text-black p-1 w-full rounded"
          {...register("password")}
        />
        {errors.password && (
          <p className="mt-0.5 text-[#ff4e4e]">The password is required.</p>
        )}

        <button
          className="mt-6 block mx-auto p-1 bg-slate-100 rounded w-[100px] text-black"
          type="submit"
        >
          Submit
        </button>
      </form>
    </div>
  );
};

export default Login;
