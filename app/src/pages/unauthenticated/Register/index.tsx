import { useForm } from "react-hook-form";
import { z } from "zod";
import { zodResolver } from "@hookform/resolvers/zod";
import { Link } from "react-router-dom";
import FormField from "../../../components/FormField";
import WhiteButton from "../../../components/WhiteButton";

const schema = z
  .object({
    username: z
      .string()
      .min(4, "The username must have at least 4 characters."),
    email: z.string().email('Invalid email.'),
    password: z.string().min(6, "Must have at least 6 characters."),
    passwordConfirmation: z.string().min(6, "Must have at least 6 characters."),
  })
  .refine((data) => data.password === data.passwordConfirmation, {
    message: "Passwords don't match",
    path: ["passwordConfirmation"],
  });

type registerSchema = z.infer<typeof schema>;

const Register = () => {
  const {
    register,
    handleSubmit,
    formState: { errors },
  } = useForm<registerSchema>({ resolver: zodResolver(schema) });

  function onSubmit({ username, email, password, passwordConfirmation }) {
    console.log({ username, email, password, passwordConfirmation });
  }

  return (
    <div className="max-w-[300px] mx-auto">
      <h1 className="text-center text-2xl">Register</h1>

      <p className="my-4">
        Already have an account?{" "}
        <Link to="/login" className="hover:text-slate-200">
          <u>Log in</u>
        </Link>
        .
      </p>

      <form onSubmit={handleSubmit(onSubmit)}>
        <FormField
          type="text"
          label="Username"
          name="username"
          register={register}
          error={errors.username}
        />
        <div className="mt-3">
          <FormField
            type="email"
            label="Email"
            name="email"
            register={register}
            error={errors.email}
          />
        </div>
        <div className="mt-3">
          <FormField
            type="password"
            label="Password"
            name="password"
            register={register}
            error={errors.password}
          />
        </div>
        <div className="mt-3">
          <FormField
            type="password"
            label="Confirm password"
            name="passwordConfirmation"
            register={register}
            error={errors.passwordConfirmation}
          />
        </div>

        <WhiteButton value="Register" />
      </form>
    </div>
  );
};

export default Register;
